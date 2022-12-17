var ul = document.getElementById('filter');
var input = document.getElementById('filterInput');

ul.addEventListener('click', function(e) {
    if (e.target.tagName === 'LI'){
        input.value = e.target.id;
        //alert(e.target.id);
        document.getElementById('orderByForm').submit();
    }
});