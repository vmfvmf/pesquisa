
<h1>Escola Estadual </h1>

<h2>Livros</h2>
<p>Mais antigo registrado em: <?=$this->Time->format($livros[0]["min"],"%d/%m/%Y");?></p>
<p>Mais novo registrado em: <?=$this->Time->format($livros[0]["max"],"%d/%m/%Y");?></p>
<p>Total: <?=$livros[0]["count"];?></p>

