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
            self::parseMatch(['group','sort','auth','link'],$comment,$data);
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
            }elseif (preg_match('/^@method/i', $comment)){
                $methods = [];
                $arr = explode(' ',$comment);
                array_shift($arr);
                $methods['return'] = $arr[0];
                array_shift($arr);
                $comment = implode(' ',$arr);
                preg_match('/(.+)\((.*)\)\s(.+)/u', $comment,$matchs);
                $methods['function'] = $matchs[1];
                $methods['text'] = trim($matchs[3]);
                $index = strpos($matchs[2],'=');
                if($index !== false){
                    $methods['default'] = trim(substr($matchs[2],$index+1));
                }
                $arr = explode(' ',$matchs[2]);
                if(strpos($arr[0],'$') === false){
                    $methods['type'] = $arr[0];
                }
                $data['method'][] = $methods;
            }
        }
        return $data;
    }
    protected static function parseMatch($name,$comment,&$data){
        if(is_array($name)){
            foreach ($name as $item){
                self::parseMatch($item,$comment,$data);
            }
        }elseif (preg_match('/^@'.$name.' /i', $comment)){
            $arr = explode(' ',$comment);
            if(isset($arr[1])){
                $data[$name] = trim($arr[1]);
            }
        }
    }
}
