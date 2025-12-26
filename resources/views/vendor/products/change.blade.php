 <label class="block text-sm font-medium text-gray-700 mb-1"> Attribute</label>
<select name="attribute" id="attribute" class="w-full rounded-md border-gray-300">
    @foreach($attributes as $attribute)
        <option value="{{$attribute->id}}">{{$attribute->name}}</option>
    @endforeach
</select>