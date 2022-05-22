@if(count($errors)>0)


@foreach($errors->all() as $error)

<ul>
    <li class="text__danger"> {{$error}}</li>
</ul>


@endforeach




@endif


<input type="text" class="form-input" placeholder="ID del articulo" id="idArticle" value="{{isset($article->id)?$article->id:old('id')}}" disabled>
<div class="input-inline">
    <label for="">Titulo:
        <input type="text" class="form-input" placeholder="Titulo del articulo" id="nameArticle" name="name" value="{{isset($article->name)?$article->name:old('name')}}">

    </label>

    <label for="idcategory">Categoria:
        <select name="category_id" id="idCategory" class="form-input">

        </select>
    </label>
</div>

<label for="">Autor:</label>
<input type="text" class="form-input" placeholder="Autor del articulo" id="authorArticle" name="author" value="{{isset($article->author)?$article->author:old('author')}}">


<label for="">Descripción:</label>
<textarea name="description" id="" cols="30" rows="10" class="form-input">
{{isset($article->description)?$article->description:old('description')}}
</textarea>
@if(isset($article->image))
<img src="{{asset('storage').'/'.$article->image}}" alt="imagen nota" id="preview" class="imgArticle">
@else
<img src="https://cdn.pixabay.com/photo/2016/03/21/20/05/image-1271454_640.png" alt="imagen nota" id="preview" class="imgArticle">

@endif
<label>
    <div class="btn btn-red"><i class="fas fa-upload"></i> imagen</div>
    <input id="imgFile" name="image" type="file" accept="image/png,image/jpeg" hidden>
</label>

<br />



<button class="{{$btnmode}}" type="submit" id="saveArticle">
    {{ $modo }}
    Articulo
</button>