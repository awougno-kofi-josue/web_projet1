<?php

require_once "config.php";

$id_domaine=$_GET['id'];

$sql="SELECT questions,proposition1,proposition2,proposition3,proposition4,reponse FROM questionnaires WHERE domaine_id='$id_domaine'";

$result=$conn->query($sql);

$questions=$result->fetch_all(MYSQLI_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../css/style.css">
    <title>Quiz</title>
    <style>
        #debut input{
            margin:20px 0;
            text-align: center;
            width: 50%;
            height: 40px;
            background-color: inherit;
            border: 1px solid #a9a9a9 ;
            border-radius: 20px;
        }
        .categorie label{
            margin-top: 15px;
        }
        #progression{
            width: 100%;
            background-color: #ddd;
            height: 8px;
            margin-bottom: 15px;
            border-radius: 10px;
            overflow: hidden;
        }
        #progBar{
            height: 100%;
            width: 0%;
            background-color: #007bff;
            transition: width 0.4 ease;
        }
        #debut {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        #debut input{
            width: 80%;
        }
        
#debut button{
    display: block;
    width: 60%;
    max-width: 400px;
    margin: 10px auto;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    background-color: #f0f0f0;
    border: 2px solid #007bff;
    border-radius: 15px;
    cursor: pointer;
    color: #333;
}

    </style>
</head>
<body>
    <?php require "header.php";?>
    <h2 id="demarrage" style="text-align: center;color:#007bff">Démarrer un nouveau Quiz</h2>

    <div id="progression" style="display: none;">
            <div id="progBar">
            </div>
        </div>
    <section class="section2">
        
        <div id="debut">
            <h3 for="nombre" id="texte_nb"> Nombre de questionnaires </h3>
            <p id="score" style="display: none;" name="nb_question"></p>
            <input type="numbre" name="nombre" id="nombre" value="5" min="5" max="20">
            <button id="demarrer" class="btn_sous">Démarrer</button>
        </div>
        
        <div id="zone_question" style="display: none;">
            <p id="time" style="font-weight:bold; color: red"></p>
            <h3 id="question"></h3>
            <div id="options"></div>
            <button id="suivant" style="display: block;" class="btn_sous">Suivant </button>
        </div>

        
    </section>





<script>
    const allquestions= <?php echo json_encode($questions,JSON_UNESCAPED_UNICODE); ?>;
    let question_sectionne=[];
    let index=0;
    let score=0;
    let timeIn=null;
    let timeOver=30;
    let aReondu=false;

    

    function aleatoire(nb){
        let quest=[...allquestions].sort(()=>0.5-Math.random()).slice(0,nb);
        return quest;
    }
    function misajourBar(indexActuel,total){
        const pourcentage=(indexActuel+1)*100/total;
        document.getElementById('progression').style.display="block";
        document.getElementById('progBar').style.width=`${pourcentage}%`;
        if(pourcentage==100){
            document.getElementById('suivant').textContent='Terminé';
        }

    }

    function afficherQuestion (index){
        const q=question_sectionne[index];
        document.getElementById("question").textContent=q.questions;
        const propositions=[q.proposition1,q.proposition2,q.proposition3,q.proposition4];


        const html=propositions.map(opt=>`<button class="option_btn">${opt}</button>`).join(" ");

        
    
        document.getElementById('options').innerHTML=html;
        document.getElementById('suivant').style.display="none";
        document.getElementById("progression").style.display='block';

        misajourBar(index,question_sectionne.length);

        const buttons=document.querySelectorAll(".option_btn");
        buttons.forEach(btn=>{
            btn.addEventListener("click",()=>{


                buttons.forEach(b=>b.disabled=true);
                if (aReondu)return;
                aReondu=true;
                clearInterval(timeIn)
                if(btn.textContent===q.reponse){
                    btn.style.backgroundColor='green';
                    score++;
                    

                }else{
                    btn.style.backgroundColor='red';
                    
                }
                
        
                document.getElementById("suivant").style.display="inline-block";
            })
        })


    aReondu=false;
    timeOver=30;
    document.getElementById('time').textContent= `Temps restant : ${timeOver}`;
    clearInterval(timeIn);
    
    timeIn=setInterval(()=>{
        timeOver--;
        document.getElementById('time').textContent="Temps restant : "+timeOver;
        if(timeOver<=0){
            clearInterval(timeIn);

            const buttons=document.querySelectorAll(".option_btn");
                buttons.forEach(b=>b.disabled=true);

                document.getElementById('suivant').style.display='inline-block';
        }
    },1000)

    };
    document.getElementById('demarrer').addEventListener("click",()=>{
        

        const nb=parseInt(document.getElementById("nombre").value);
        index=0;
        score=0;
        question_sectionne=aleatoire(nb);
        document.getElementById('zone_question').style.display="block";
        document.getElementById('debut').style.display='none';
        document.getElementById('demarrage').textContent="Quiz en cours";
        afficherQuestion(index);
        
    })
    
    document.getElementById('suivant').addEventListener("click",()=>{
        index++;
        if(index<question_sectionne.length){
            afficherQuestion(index);
        }else{
            
            document.getElementById("zone_question").style.display='block';
            document.getElementById('time').style.display="none"
            document.getElementById('question').textContent=`Score final :  ${score} / ${question_sectionne.length}`
            document.getElementById('demarrage').textContent='Quiz terminé';
            document.getElementById('options').style.display="none"
            document.getElementById('suivant').textContent="Recommencer";
            

            document.getElementById('suivant').addEventListener("click",()=>{
            const dem=document.getElementById('suivant');
            if(dem.textContent==='Recommencer'){
            location.reload();
            return;
        }
        });
        
    }
    })

</script>
</body>
</html>