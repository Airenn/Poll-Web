<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" media="screen" type="text/css" href="css/page-public.php" />
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.easing.min.js"></script>
        <script src="js/classie.js"></script>
        <script src="js/cbpAnimatedHeader.js"></script>
        <title>Page public</title>
    </head>
    <body>
        <div id="conteneur">
            
            <header>
                <p id="question">Question 2 : Aimez-vous les animaux ?</p>
                <div id="nbmsg">
                    <img src="images/enveloppe.png" alt=""/>
                    <p id="nbrecus">5</p>
                </div>
            </header>

            
            <section>
                <p class="rep">A : Les chiens
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                            <span class="sr-only">60% Complete</span>
                        </div>
                    </div>
                </p>
                <p class="rep">B : Les chats
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">60%</div>
                    </div>
                </p>
                <p class="rep">C : Les chevaux
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                        </div>
                    </div>
                </p>
                <p class="rep">D : Je n'aime pas les animaux
                    <div class="progress">
                        <div class="progress-bar progress-bar" style="width: 35%">
                            <span class="sr-only">35% Complete (success)</span>
                        </div>
                        <div class="progress-bar progress-bar-warning progress-bar-striped active" style="width: 20%">
                            <span class="sr-only">20% Complete (warning)</span>
                        </div>
                    </div>
                </p>
            </section>
        

            <footer>
                <p>
                    Envoyez votre réponse (exemple: <strong>2A</strong>, ou <strong>2B</strong>) par SMS au <strong>06 xx xx xx xx</strong><br/>
                    Pour donner plusieurs réponses, envoyez par exemple <strong>2AB</strong>
                </p>
            </footer>
            
        </div>
    </body>
</html>
