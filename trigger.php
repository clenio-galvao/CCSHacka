<?php
/**
 * Explicação sobre a aplicação
 * 
 * Esta aplicação será uma CDN que, no geral, significa uma rede de distribuição de conteúdo e envolve procedimentos de redes de computadores e muitos servidores. Mas, aqui, somente será aplicado o conceito genérico e resumido de CDN: ponto de distribuição de conteúdo.
 * 
 * Isso quer dizer que os códigos em PHP aqui escritos serão utilizados para entregar o conteúdo Front-End da nossa solução. Esses conteúdos são os códigos CSS, HTML, JavaScript, imagens etc.
 * 
 * O que cada pasta do projeto contém?
 * 
 * application - Contém os códigos PHP da CDN;
 * assets      - Contém arquivos tais como CSS e JavaScript que serão usados para exibir e interagir com o usuário do lado Front-End;
 * media       - Contém imagens, vídeos e arquivos que serão compartilhados no lado Front-End;
 * templates   - Contém os HTML de cada tela da aplicação.
*/

define('ROOTSERVER', dirname(__FILE__) . DIRECTORY_SEPARATOR);

if(file_exists($path = ROOTSERVER . 'application/load.php') and is_readable($path)) require_once $path;
