<div class="form-group">
    <label for="name">Nome do produto: </label>
    <input class="form-control" type="text" id="name" name="name" value="{{ isset($produto->name) ? $produto->name : ''}}" required>
</div>

<div class="form-group">
    <label for="descricao">Descrição: </label>
    <textarea class="form-control" id="descricao" name="descricao" rows="3" required>{{ isset($produto->descricao) ? $produto->descricao : ''}}</textarea>
</div>

<div class="row">
    <div class="form-group col-sm-4">
        <label for="categoria">Categoria: </label>
        <input class="form-control" type="text" id="categoria" name="categoria" value="{{ isset($produto->categoria) ? $produto->categoria : ''}}" required>
    </div>

    <div class="form-group col-sm-4">
        <label for="qtd">Quantidade: </label>
        <input class="form-control" type="number" min="0" id="qtd" name="qtd" value="{{ isset($produto->qtd) ? $produto->qtd : ''}}" required>
    </div>

    <div class="form-group col-sm-4">
        <label for="preco">Preço: </label>
        <input class="form-control" type="number" step=".50" placeholder="0,00" id="preco" name="preco" value="{{ isset($produto->preco) ? $produto->preco : ''}}" required>
    </div>
</div>

<div class="form-group">
    <label for="imagem">Imagem: </label>
    <input type="file" class="form-control-file" name="imagem" accept="image/png, image/jpeg" id="imagem" aria-describedby="fileHelp" required>
    <small id="fileHelp" class="form-text text-muted">
        Imagem do produto.
    </small>
</div>


<br>