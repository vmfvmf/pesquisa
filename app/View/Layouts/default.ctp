<?php

setlocale(LC_MONETARY, "pt_BR","ptb");
echo $this->Html->script('jquery', false);
echo $this->Html->script('jquery-ui', false);
echo $this->Html->script('superfish', false);
echo $this->Html->script('hoverIntent', false);
echo $this->Html->script('modernizr', false);
echo $this->Html->script('jquery.fancybox', false);
echo $this->Html->css('jquery.fancybox', false);
echo $this->Html->css('actions', false);
echo $this->Html->css('fastwork', false);
echo $this->Html->css('jquery-ui');
echo $this->Html->css('megafish');
echo $this->Html->css('superfish');
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
    <head>
	<?php echo $this->Html->charset(); ?>
        <title>
		<?php echo $title_for_layout; ?>
        </title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
                
                ?>
        <script>
            $(function () {
                $('.fancybox').fancybox();
                $.fn.superfish.defaults = {
                    pathLevels: 1, // the number of levels of sub-menus that remain open or are restored using pathClass
                    delay: 200, // the delay in milliseconds that the mouse can remain outside a sub-menu without it closing
                    animation: {opacity: 'show'}, // an object equivalent to first parameter of jQuery’s .animate() method. Used to animate the sub-menu open
                    animationOut: {opacity: 'show'}, // an object equivalent to first parameter of jQuery’s .animate() method Used to animate the sub-menu closed
                    speed: 'normal', // speed of the opening animation. Equivalent to second parameter of jQuery’s .animate() method
                    speedOut: 'fast', useClick: true, autoArrows: true, hoverClass: 'sfHover', pathClass: 'overideThisToUse'
                };
                $('#mainnav').superfish({});
                $(document).tooltip();
            });

        </script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1><?=$this->Html->link('SGBVMF','../'); ?></h1>
                <nav>                        
                    <ul id="mainnav" class="sf-menu" >
                        <?=$this->fetch('menu-principal'); ?>
                    </ul>
                </nav>
            </div>
            <div id="inner" style="display:none; width: 400px;">
                            <?=$this->element('login'); ?>
            </div>
            <div id="fastwork">Você está aqui: <?php echo $this->fetch('fastwork'); ?>
                <div style="float:right;">
                      <?php if($this->Session->check('Auth.User')){ ?>
                    Seja bem vindo <?= $this->Session->read('Auth.User.nome'); ?>
                            <?=$this->Html->link('Sair',array('controller' => 'Users', 'action' => 'logout'));?>
                        <?php }else{ ?>
                    <a href="#inner" class="fancybox">Login</a>
                        <?php } ?>
                </div>
            </div>
            <div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
            </div>
            <div id="footer">
			<?php echo $this->element('sql_dump'); ?>
            </div>
        </div>

    </body>
</html>

