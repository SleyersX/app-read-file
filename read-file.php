<?php
    define("template", parse_ini_file('templates.ini', true));
    $fileName = template['config']['fileName'];
    
    
    /*
    $delimitador = ';';
    $cerca = '"';
    $array=array();
    
    // Abrir arquivo para leitura
    
    $f = fopen('layout.csv', 'r');
    if ($f) { 

        // Ler cabecalho do arquivo
        $cabecalho = fgetcsv($f, 0, $delimitador);

        // Enquanto nao terminar o arquivo
        while (!feof($f)) { 

            // Ler uma linha do arquivo
            $linha = fgetcsv($f, 0, $delimitador);
            if (!$linha) {
                continue;
            }
            
            // Montar registro com valores indexados pelo cabecalho
            $registro = array_combine($cabecalho, $linha);
            //print_r($registro);
            //printf("%s\n",$registro['layout']);
            // Obtendo o nome
            //$array[$registro['template']] = array_map( 'null', $registro['campo']);
            array_push($array,$registro);
            $registro['campo'].PHP_EOL;
        }
        fclose($f);
    }
    //print_r($registro);
    //$array=array_map('str_getcsv',file('layout.csv'));
    print_r($array);
    //print_r(template);
    //$headers=template['headers'];
    //print_r($headers);
    //$detail=template['detail'];
    //print_r($detail);
    
    //$size=sizeof(template);
    //echo "$size\n";
    /*
    for ($i=0; $i < $size; $i++) { 
        //print_r(template["$i"]);
        foreach(template["$i"] as $key => $value){
            echo "{$key}->{$value}\n";
        }
    }
    /*
    foreach(template as $key => $value){
        echo "{$key}->{$value}\n";
    }
    /*
    foreach($headers as $key => $value){
        echo "{$key}->{$value}\n";
        //printf("%s\n",$value);
        //printf("0->%s-%s\n",$start,$end);
        //$start=($end+1);
        //$end=(($start-1)+$value);
        //printf("1->%s-%s\n", $start,$end);
        //$line = fgets($file_handle,2000);
        //$line = fseek($file_handle,2);
        //$x=substr($line,$start,$value);
        //printf("%s\n", $x);
    }
    */
    
    if(file_exists($fileName) && is_readable($fileName) && filesize($fileName) > 0){
        $file_handle = fopen($fileName, "r");
        while(!feof($file_handle)){
            $start=1;
            $end=1;
            $line = fgets($file_handle, 4096);
            $pos=substr($line,0,1);
            if(strlen($pos) === 0){
                break;
            }
            if(isset(template["$pos"])){
                foreach(template["$pos"] as $key => $value){
                    $start=($end+1);
                    $end=(($start-1)+$value);
                    $x=substr($line,($start-1),$value);
                    printf("%s='%s'\n", $key, $x);
                }
            }else{
                printf("Template[%s], não foi encontrado em template.ini .\n", $pos);
            }
            printf("\n%s\n",str_pad("",200,"-"));
        }    
    
        fclose($file_handle);
    }
    /*
    if(file_exists($fileName) && is_readable($fileName) && filesize($fileName) > 0){
        $file_handle = fopen("file.txt", "r");
        while(!feof($file_handle)){
            $i=0;
            $line = fgets($file_handle,2000);
            //$line = fseek($file_handle,2);
            $x=substr($line,0,3);
            printf("%s\n", $x);
            $i+=1;
            if($i==3){
                break;
            }
        }    
    
        fclose($file_handle);
    }*/