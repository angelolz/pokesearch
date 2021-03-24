function changeRPP(form, pkmnCount)
{
    var currentPage = document.getElementById("currentPage").value;
    var rpp = document.getElementById("numResults").value;

    console.log(currentPage + " > " + Math.floor(pkmnCount/rpp) + "? " + (currentPage > Math.floor(pkmnCount/rpp)))
    if(currentPage > Math.ceil(pkmnCount/rpp))
    {
        document.getElementById("currentPage").value = Math.ceil(pkmnCount/rpp);
    }

    form.submit();
}
