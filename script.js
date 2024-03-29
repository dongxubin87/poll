function fetchSurveys() {
  var surveysData = ['Survey 1', 'Survey 2', 'Survey 3'];

  var surveyList = document.querySelector('.survey-list');
  surveyList.innerHTML = '';

  surveysData.forEach(function (surveyTitle) {
    var listItem = document.createElement('li');
    listItem.textContent = surveyTitle;
    listItem.addEventListener('click', function () {
      handleSurveyClick(surveyTitle);
    });
    surveyList.appendChild(listItem);
  });
}

function handleSurveyClick(surveyTitle) {
  alert('Selected survey: ' + surveyTitle);
}
window.onload = fetchSurveys;
