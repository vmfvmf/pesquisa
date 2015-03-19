<?php 
            // Generate Barcode data 
            $this->Barcode->barcode(); 
            $this->Barcode->setType('C128'); 
            $this->Barcode->setCode($id); 
            $this->Barcode->setSize(80,200); 

            // Generate filename       
            $file = 'img/barcode/code_'.$id.'.png'; 

            // Generates image file on server             
            //$barcode
            $this->Barcode->writeBarcodeFile($file); 

            // Display image 
            echo $this->Html->scriptBlock('window.location.href="'.$this->Html->url(array('controller' 
                => 'Livros', 'action' => 'index'), true).'"'); 

            ?>