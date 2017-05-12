<?php
function html($text) 
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

function htmlout($text)
{
	echo html($text);
}

function markdown2html($text)
{
    $text = html($text);
    
    //mocne wyróżnienie
    $text = preg_replace('/__(.+?)__/s', '<strong>$1</strong>', $text);
    $text = preg_replace('/\*\*(.+?)\*\*/s', '<strong>$1</strong>', $text);
    
    //wyróżnienie
    $text = preg_replace('/_([^_]+)_/', '<em>$1</em>', $text);
    $text = preg_replace('/\*([^\*]+)\*/', '<em>$1</em>', $text);
    
    //Konwersja z systemu Windows (\r\n) do systemu Unix (\n)
    //$text = preg_replace('/\r\n/', "\n", $text);
    $text = str_replace("\r\n", "\n", $text);
    
    
    //Konwersja z systemu Macintosh (\r) do systemu Unix (\n)
    //$text = preg_replace('/\r/', "\n", $text);
    $text = str_replace("\r", "\n", $text);
    
    //Akapity
    //$text = '<p>' . preg_replace('/\n\n/', '<p></p>', $text) . '</p>';
    $text = '<p>' . str_replace("\n\n", '</p><p>', $text) . '</p>';
    
    
    //Oznaczanie podzialu wiersza
    //$text = preg_replace('/\n/', '<br>', $text);
    $text = str_replace("\n", '<br>', $text);
    
    //Hiperłącza [aktywny tekst](adres URL)
    $text = preg_replace('/\[([^\]]+)]\(([-a-z0-9._~:\/?#@!$&\'()*+,;=%]+)\)/i', '<a href="$2">$1</a>', $text);
            
    
    
    
    return $text;
}

function markdownout($text) 
{
    echo markdown2html($text);
}