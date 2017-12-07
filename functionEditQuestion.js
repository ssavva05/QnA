function addAnswer(lid,ltitle,q,a,ta,act){
		a++;
		window.location.href="editQuestion.php?var="+lid+"&var1="+ltitle+"&question="+q+"&answer="+a+"&totalans="+ta+"&action="+act+"&r=1";
		
	};
 function deleteAnswer(lid,ltitle,q,a,ta,act){
		a--;
		window.location.href="editQuestion.php?var="+lid+"&var1="+ltitle+"&question="+q+"&answer="+a+"&totalans="+ta+"&action="+act+"&r=1";
		
	};
function goBack(lid,ltitle,q,a,ta,act){
	if(act==1){
		q++;
	}
	ta+=a;
		window.location.href="myQuestions.php?var="+lid+"&var1="+ltitle+"&question="+q+"&totalans="+ta;
	};
function deleteAllAnswers(lid,ltitle,q,ta,act){
	window.location.href="editQuestion.php?var="+lid+"&var1="+ltitle+"&question="+q+"&answer=1"+"&totalans="+ta+"&action="+act+"&r=0";
	
};