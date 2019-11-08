$("#searchIcon").click(function(){
    $("#leftSideBar").toggle();
    $("#centerBar").toggle();
    $("#focus").focus();
    $("#showEmptyLeftSideBar").toggle();
  });

var input = document.getElementById("id");
input.addEventListener("keyup", function(event) {
    event.preventDefault();
    if (event.keyCode === 13) {
        document.getElementById("submitSearchById").click();
    }
});
function ShowMoreReligion()
{
    document.getElementById("ShowMoreReligion1").style.display="none";
    document.getElementById("ShowMoreReligion2").style.display="block";
    document.getElementById("ShowLessReligion1").style.display="block";
}
function ShowLessReligion()
{
    document.getElementById("ShowMoreReligion1").style.display="block";
    document.getElementById("ShowMoreReligion2").style.display="none";
    document.getElementById("ShowLessReligion1").style.display="none";
}
function ShowMoreEducation()
{
document.getElementById("ShowMoreEducation1").style.display="none";
document.getElementById("ShowMoreEducation2").style.display="block";
document.getElementById("ShowLessEducation1").style.display="block";
}
function ShowLessEducation()
{
    document.getElementById("ShowMoreEducation1").style.display="block";
    document.getElementById("ShowMoreEducation2").style.display="none";
    document.getElementById("ShowLessEducation1").style.display="none";
}
function ShowMoreSalary()
{
document.getElementById("ShowMoreSalary1").style.display="none";
document.getElementById("ShowMoreSalary2").style.display="block";
document.getElementById("ShowLessSalary1").style.display="block";
}
function ShowLessSalary()
{
    document.getElementById("ShowMoreSalary1").style.display="block";
    document.getElementById("ShowMoreSalary2").style.display="none";
    document.getElementById("ShowLessSalary1").style.display="none";
}
function ShowMoreLanguages()
{
document.getElementById("showMoreLanguages1").style.display="none";
document.getElementById("showMoreLanguages2").style.display="block";
document.getElementById("ShowLessLanguages1").style.display="block";
}
function ShowLessLanguages()
{
    document.getElementById("showMoreLanguages1").style.display="block";
    document.getElementById("showMoreLanguages2").style.display="none";
    document.getElementById("ShowLessLanguages1").style.display="none";
}
function ShowMoreClan()
{
document.getElementById("showMoreClan1").style.display="none";
document.getElementById("showMoreClan2").style.display="block";
document.getElementById("ShowLessClas1").style.display="block";
}
function ShowLessClan()
{
    document.getElementById("showMoreClan1").style.display="block";
    document.getElementById("showMoreClan2").style.display="none";
    document.getElementById("ShowLessClan1").style.display="none";
}

