function changeBar()
{
    var hpVal = getPercent($("#hp").attr("value"));
    var atkVal = getPercent($("#attack").attr("value"));
    var defVal = getPercent($("#defense").attr("value"));
    var spAtkVal = getPercent($("#special-attack").attr("value"));
    var spDefVal = getPercent($("#special-defense").attr("value"));
    var spdVal = getPercent($("#speed").attr("value"));

    $("#hp").width(hpVal.toString().concat("%"));
    $("#attack").width(atkVal.toString().concat("%"));
    $("#defense").width(defVal.toString().concat("%"));
    $("#special-attack").width(spAtkVal.toString().concat("%"));
    $("#special-defense").width(spDefVal.toString().concat("%"));
    $("#speed").width(spdVal.toString().concat("%"));
}

function getPercent(num)
{
    var percent = (num / 255) * 100;

    //TODO: remove this workaround lol
    percent = percent == 100 ? 95 : percent;
    return percent;
}
