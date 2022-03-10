<?php

namespace ExAdmin\ui\support;



class Annotation
{
    public static function parse($doc){
        if (preg_match('#^/\*\*(.*)\*/#s', $doc, $comment) === false) {
            return false;
        }
        if (!isset($comment[1])) {
            return false;
        }
        $comment = trim($comment [1]);
        if (preg_match_all('#^\s*\*(.*)#m', $comment, $lines) === false) {
            return false;
        }
        $comments = end($lines);
        $title = array_shift($comments);
        $data['title'] = trim($title);
        foreach ($comments as $comment){
            $param = [];
            $comment = ltrim($comment);
            if (preg_match('/^@param/i', $comment)) {
                $arr = explode(' ',$comment);
                array_shift($arr);
                $varIndex = -1;
                foreach ($arr as $index => $row){
                    if(Str::startsWith($row,'$')){
                        $varIndex = $index;
                    }
                }
                $descArr = array_slice($arr,$varIndex+1);
                $desc = trim(implode(' ',$descArr));
                if(preg_match("/\{(.*)\}/U",$desc,$match)){
                    $desc = str_replace($match[0],'',$desc);
                    $param['value'] = $match[1];
                }
                $param['desc'] = $desc;
                if($varIndex == 1){
                    $param['type'] = trim($arr[0]);
                }
                $param['var'] = trim(substr($arr[$varIndex],1));
                $data['params'][] = $param;
            }elseif (preg_match('/^@response/i', $comment)){
                $arr = explode(' ',$comment);
                array_shift($arr);
                $param['resource'] = array_shift($arr);
                $param['desc'] = trim(implode(' ',$arr));
                $data['response'][] = $param;
            }elseif (preg_match('/^@header/i', $comment)){
                $arr = explode(' ',$comment);
                array_shift($arr);
                $param['key'] = array_shift($arr);
                $desc = trim(implode(' ',$arr));
                if(preg_match("/\{(.*)\}/U",$desc,$match)){
                    $desc = str_replace($match[0],'',$desc);
                    $param['value'] = $match[1];
                }
                $param['desc'] = $desc;
                $data['header'][] = $param;
            }elseif (preg_match('/^@group/i', $comment)){
                $arr = explode(' ',$comment);
                if(isset($arr[1])){
                    $data['group'] = trim($arr[1]);
                }
            }elseif (preg_match('/^@sort/i', $comment)){
                $arr = explode(' ',$comment);
                if(isset($arr[1])){
                    $data['sort'] = trim($arr[1]);
                }
            }elseif (preg_match('/^@auth/i', $comment)){
                $arr = explode(' ',$comment);
                if(isset($arr[1])){
                    $data['auth'] = trim($arr[1]);
                }
            }
        }
        return $data;
    }
}
