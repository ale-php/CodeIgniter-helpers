<?php
 function miniatura($width, $height, $img,$patch)
    {

    	$this->load->library('image_lib');
    	
        // Checa se a imagem existe; se não existir, usa uma imagem padrão
        $img = is_file($patch.'/'.$img) ? $img : 'default.jpg';
 
        // Se a miniatura já existir, ela é que será usada
        // (não há necessidade de usar a GD library de novo)
        if ( ! is_file($patch.'/' . $width . 'x' . $height . '_' . $img))
        {
            $config['source_image'] = $patch.'/' . $img;
            $config['new_image']    = $patch.'/' . $width . 'x' . $height . '_' . $img;
            $config['width']        = $width;
            $config['height']       = $height;
             
            $this->image_lib->initialize($config);
            $this->image_lib->resize_crop();
        }
         
        header('Content-Type: image/jpg');
        readfile($patch.'/' . $width . 'x' . $height . '_' . $img);

        unlink($patch.'/'.$img);

        return $patch.'/' . $width . 'x' . $height . '_' . $img;
    }

    ?>