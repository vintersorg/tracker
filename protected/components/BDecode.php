<?php
/*********************************************************************
 *  Author:     Andris Causs
 *  Email:      cypher[at]inbox[dot]lv
 *  Date:       July 07, 2006
 *  Purpose:    Parse binary encoded (torrent) files into nested array.
 *
 *  You are free to use and modify the code. Just do not copy it and post
 *  somewhere as your own.
 *  Therefore I reserve all rights to this code in modified or unmodified form.
 *
 *  -- Here is a list of some of the most used properties:
 *    $torrent->result['announce']                    // string
 *    $torrent->result['announce-list']               // array
 *    $torrent->result['comment']                     // string
 *    $torrent->result['created by']                  // string
 *    $torrent->result['creation date']               // unix timestamp
 *    $torrent->result['encoding']                    // string
 *    $torrent->result['info']['files']               // array
 *    $torrent->result['info']['files'][?]['length']  // integer
 *    $torrent->result['info']['files'][?]['path']    // string
 *    $torrent->result['info']['name']                // string
 *    $torrent->result['info']['piece length']        // integer
 *    $torrent->result['info']['pieces']              // string
 *    $torrent->result['info']['private']             // integer
 *    $torrent->result['modified-by']                 // array
 *
 *  See http://wiki.theory.org/BitTorrentSpecification for bittorrent specification
 */

final class BDecode {
    private $content;            // string containing contents of file
    private $pointer = 0;        // current position pointer in content
    public $result = array();    // result array containing all decoded elements


    /**************************************************************************
     * Info: Parses bencoded file into array.
     * Args: {string} filepath: full or relative path to bencoded file
     **************************************************************************/
    function __construct() {
    }

	function bdecode($filepath) {
	        $this->content = @file_get_contents($filepath);
	
	        if (!$this->content) {
	            $this->throwException('File does not exist!');
	        } else {
	            if (!isset($this->content)) {
	                $this->throwException('Error opening file!');
	            } else {
	                $this->result = $this->processElement();
	            }
	        }
	        unset($this->content);
	    
	    return $this->result;
	}

    /**************************************************************************
     * Info: Clear class variables.
     * Args: none
     **************************************************************************/
    function __destruct() {
        unset($this->content);
        unset($this->result);
    }


    /**************************************************************************
     * Info: Terminates decoding process and returns error.
     * Args: {string} error [optional] - error description
     **************************************************************************/
    private function throwException($error = 'error parsing file') {
            $this->result = array();
            $this->result['error'] = $error;
    }

    /**************************************************************************
     * Info: Processes element depending on its type.
     *       Results in error if no valid identifier is found.
     * Args: none
     **************************************************************************/
    private function processElement() {
        switch($this->content[$this->pointer]) {
        case 'd':
            return $this->processDictionary();
            break;
        case 'l':
            return $this->processList();
            break;
        case 'i':
            return $this->processInteger();
            break;
        default:
            if (is_numeric($this->content[$this->pointer])) {
                return $this->processString();
            } else {
                $this->throwException('Unknown BEncode element');
            }
            break;
        }
    }

    /**************************************************************************
     * Info: Processes dictionary entries.
     *       Returns array of dictionary entries.
     * Args: none
     **************************************************************************/
    private function processDictionary() {
        if (!$this->isOfType('d'))
            $this->throwException();

        $res = array();
        $this->pointer++;

        while (!$this->isOfType('e')) {
            $elemkey = $this->processString();

            switch($this->content[$this->pointer]) {
            case 'd':
                $res[$elemkey] = $this->processDictionary();
                break;
            case 'l':
                $res[$elemkey] = $this->processList();
                break;
            case 'i':
                $res[$elemkey] = $this->processInteger();
                break;
            default:
                if (is_numeric($this->content[$this->pointer])) {
                    $res[$elemkey] = $this->processString();
                } else {
                    $this->throwException('Unknown BEncode element!');
                }
                break;
            }
        }

        $this->pointer++;
        return $res;
    }

    /**************************************************************************
     * Info: Processes list entries.
     *       Returns array of list entries found between 'l' and 'e' identifiers.
     * Args: none
     **************************************************************************/
    private function processList() {
        if (!$this->isOfType('l'))
            $this->throwException();

        $res = array();
        $this->pointer++;

        while (!$this->isOfType('e'))
            $res[] = $this->processElement();

        $this->pointer++;
        return $res;
    }

    /**************************************************************************
     * Info: Processes integer value.
     *       Returns integer value found between 'i' and 'e' identifiers.
     * Args: none
     **************************************************************************/
    private function processInteger() {
        if (!$this->isOfType('e'))
            $this->throwException();

        $this->pointer++;

        $delim_pos = strpos($this->content, 'e', $this->pointer);
        $integer = substr($this->content, $this->pointer, $delim_pos - $this->pointer);
        if (($integer == '-0') || ((substr($integer, 0, 1) == '0') && (strlen($integer) > 1)))
            $this->throwException();

        $integer = abs(intval($integer));
        $this->pointer = $delim_pos + 1;
        return $integer;
    }

    /**************************************************************************
     * Info: Processes string value.
     *       Returns string value found after '%:' identifier, where '%' is any
     *       valid integer.
     * Args: none
     **************************************************************************/
    private function processString() {
        if (!is_numeric($this->content[$this->pointer])) {
            $this->throwException();
        }

        $delim_pos = strpos($this->content, ':', $this->pointer);
        $elem_len = intval(substr($this->content, $this->pointer, $delim_pos - $this->pointer));
        $this->pointer = $delim_pos + 1;

        $elem_name = substr($this->content, $this->pointer, $elem_len);

        $this->pointer += $elem_len;
        return $elem_name;
    }

    /**************************************************************************
     * Info: Checks if identifier at current pointer is of supplied type.
     * Args: {char} type - character denoting required type.
     *   Usually one of [d,l,i,e].
     **************************************************************************/
    private function isOfType($type) {
        return ($this->content[$this->pointer] == $type);
    }

    /**************************************************************************
     * Info: BEncodes the array of data
     * Args: {array} type - Array of data in the torrent.
     **************************************************************************/
	function bencode($element) {
    $out = "";
        if (is_int($element)) {
            $out = 'i'.$element.'e';
        } else if (is_string($element)) {
            $out = strlen($element).':'.$element;
        } else if (is_array($element)) {
            ksort($element);
            if (is_string(key($element))) {
                $out ='d';
                foreach($element as $key => $val)
                    $out .= self::bencode($key) . self::bencode($val);
                $out .= 'e';
            } else {
                $out ='l';
                foreach($element as $val)
                    $out .= self::bencode($val);
                    $out .= 'e';
            }
        } else {
            print("$element");
            trigger_error("unknown element type: '".
            gettype($element)."'", E_USER_ERROR);
            exit();
        }
        return $out;
    }

}

/*
$bd = new BDecode();
$bd->bdecode("/path/to/torrent.torrent");
print( sha1( $bd->bencode($bd->result['info']) ) );
*/
?>