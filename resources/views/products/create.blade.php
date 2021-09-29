<form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf


    <label for="label">
        Nom du Produit
    </label>
    <input class="" id="label" type="text" name="label" placeholder="Jane" value="{{ old('label') }}" required>

    @error('label')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    <label for="ref">
        Référence produit
    </label>
    <input class="" id="ref" type="text" name="ref" placeholder="GUIT01" value="{{ old('ref') }}" required>

    @error('ref')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    
    <label class="" for=" picture">
        Photo du produit
    </label>
    <input class=""
            id="picture" name="picture" type="file" value="{{ old('picture') }}" required>

    @error('picture')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    <label for="description">
        Description du produit
    </label>
    <textarea class="" id="description" type="text" name="description" placeholder="lorem ..." value="{{ old('description') }}" required></textarea>

    @error('description')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    <label for="EAN">
        Code barre
    </label>
    <input class="" id="EAN" type="text" name="EAN" value="{{ old('EAN') }}" required>

    @error('EAN')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    <label for="color">
        Couleur(s) dominante(s)
    </label>
    <input class="" id="color" type="text" name="color" value="{{ old('color') }}" required>

    @error('color')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    <label for="unit_price_HT">
        Prix unitaire hors taxe
    </label>
    <input class="" id="unit_price_HT" type="number" min="0" step=".01" value="0" name="unit_price_HT" value="{{ old('unit_price_HT') }}" required>

    @error('unit_price_HT')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    <label for="supply_ref">
        Référence produit du fournisseur
    </label>
    <input class="" id="supply_ref" type="text" name="supply_ref" placeholder="bla..." value="{{ old('supply_ref') }}" required>

    @error('supply_ref')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    <label for="supply_product_name">
        Nom du produit fournisseur
    </label>
    <input class="" id="supply_product_name" type="text" name="supply_product_name" placeholder="Nom donné par le fournissuer" value="{{ old('supply_product_name') }}" required>

    @error('supply_product_name')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    <label for="supply_unit_price_HT">
        prix unitaire hors taxe du fournisseur
    </label>
    <input class="" id="supply_unit_price_HT" type="number" min="0" step=".01" value="0" name="supply_unit_price_HT" value="{{ old('supply_unit_price_HT') }}" required>

    @error('supply_unit_price_HT')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    <label for="stock">
        Stock disponible à la vente
    </label>
    <input class="" id="stock" type="number" min="1" step="1" value="1" name="stock" value="{{ old('stock') }}" required>

    @error('stock')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    <label for="stock_alert">
        Stock_alert disponible à la vente
    </label>
    <input class="" id="stock_alert" type="number" min="0" step="1" value="0" name="stock_alert" value="{{ old('stock_alert') }}" required>

    @error('stock_alert')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror

    
    <label class="" for=" categories">
        Catégories
    </label>

    <select class=""
                id="category" name="category" value="{{ old('category') }}">

        @foreach ($categories as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>


    @error('category')
        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
    @enderror



    <div class="text-center">
        <button type="submit">Publier</button>

    </div>

</form>
