const { heroData, monsterData } = window.gameConfig;
console.log(heroData);
console.log(monsterData);
   
    let affichagePvHeros = document.getElementById('pv_heros');
    let affichagePvMonstre = document.getElementById('pv_monstre');
    let affichageManaHeros = document.getElementById('mana_heros');
    let affichageNomMonstre = document.getElementById('nom_monstre');
    let affichageForceHeros = document.getElementById('force_heros');
    let affichageLog = document.getElementById('affichage_log');

    let boutonSortEmpoisonnement = document.getElementById('sort_empoisonnement');
    let boutonSortSoin = document.getElementById('sort_soin');
    let boutonSortForce = document.getElementById('sort_force');
    let boutonSortMana = document.getElementById('sort_mana');
    let boutonPotionSoin = document.getElementById('potion_soin');
    let boutonPotionForce = document.getElementById('potion_force');
    let boutonPotionMana = document.getElementById('potion_mana');
    let boutonAttaque = document.getElementById('attaque');
    

    affichagePvHeros.textContent = heroData.pv;
    affichagePvMonstre.textContent = monsterData.pv;
    affichageForceHero.textContent = heroData.strength;
    affichageManaHeros.textContent = heroData.mana;
    
    
    /**** caractéristique héros ****/

    
    let forceHeros = hero.strength;
    let nbManaHeros = 100;
    let coutManaSort = 10;
    let initiativeHeros = 30;
    let niveauHeros = 1;

    /**** inventaire ****/

    let nbPotionSoin = 3;
    let nbPotionForce = 2;
    let nbPotionMana = 1;
    let NomArmePrincipale = "épée";
    let dommageArmePrincipale = 10;

    /**** caractéristique sort ****/

    /*sort d'empoisonnement*/
    let dommageSort = 30;

    /*sort de soin*/
    let soinSort = 20;

    /*sort d'attaque*/
    let forceSort = 20;

    /*sort de mana*/
    let manaSort = 20;

    /**** caractéristique potion ****/

    /*potion de soin*/
    let soinPotion = 50;

    /*potion d'attaque*/
    let forcePotion = 40;

    /*potion de mana*/
    let manaPotion = 30

    /**** caractéristique monstre ****/
    let nbPvMonstre = 500;
    let forceMonstre = 50;
    let manaMonstre = 100;
    let xpMonstre = 100;

      
  /**** fonctions ****/  

 //Lance une attaque simple sur le monstre
    function attaqueSimple(){
        if(this.monster.pv > 0 && nbPvHeros >0){
            this.monster.pv = this.monster.pv - forceHeros;
        if(this.monster.pv < 0){
            this.monster.pv = 0;
        }
        affichagePvMonstre.textContent = this.monster.pv;
        }
    }

    //Le monstre lance une attaque simple sur le héros

    function monstreAttaque(){
        if(nbPvHeros > 0 && nbPvMonstre >0){
            nbPvHeros = nbPvHeros - forceMonstre;
            if(nbPvHeros < 0){
                nbPvHeros =0;
            }
            affichagePvHeros.textContent = nbPvHeros;
        }
    }

    //Lance un sort d'empoisonnement

    function lancerSortEmpoisonnement(){
        nbManaHeros = nbManaHeros - coutManaSort;
        if(nbManaHeros >=0 && nbPvMonstre >0 && nbPvHeros >0){
            nbPvMonstre = nbPvMonstre - dommageSort;
            if(nbPvMonstre <0){
                pvRestant =0;
            }
            affichagePvMonstre.textContent = nbPvMonstre;
            affichageManaHeros.textContent = nbManaHeros;
        }
        else{
            nbManaHeros =0;
            affichageLog.textContent = "Vous n'avez plus assez de mana pour jeter un sort";
        }
    }

    //Le monstre lance un sort d'empoisonnement

    function monstreLancerSortEmpoisonnement(){
        manaMonstre = manaMonstre - coutManaSort;
        if(manaMonstre >=0 && nbPvMonstre >0 && nbPvHeros >0){
            nbPvHeros = nbPvHeros - dommageSort;
            if(nbPvHeros <0){
                pvRestant =0;
            }
            affichagePvHeros.textContent = nbPvHeros;
        }
        else{
            manaMonstre =0;
            affichageLog.textContent = "Le monstre n'a plus assez de mana pour jeter un sort";
        }
    }

    //Lance un sort de soin

    function lancerSortSoin(){
        nbManaHeros = nbManaHeros - coutManaSort;
        if(nbManaHeros >=0 && nbPvHeros >0){
            nbPvHeros = nbPvHeros + soinSort;
            affichagePvHeros.textContent = nbPvHeros;
            affichageManaHeros.textContent = nbManaHeros;
        }
        else{
            nbManaHeros =0;
            affichageLog.textContent = "Vous n'avez plus assez de mana pour jeter un sort";
        }
    }

    //Le monstre lance un sort de soin
    function monstreLancerSortSoin(){
        manaMonstre = manaMonstre - coutManaSort;
        if(manaMonstre >=0 && nbPvHeros >0){
            nbPvMonstre = nbPvMonstre + soinSort;
            affichagePvMonstre.textContent = nbPvMonstre;
            affichageManaHeros.textContent = manaMonstre;
        }
        else{
            manaMonstre =0;
            affichageLog.textContent = "Vous n'avez plus assez de mana pour jeter un sort";
        }
    }

    //Lance un sort qui augmente la force

    function lancerSortForce(){
        nbManaHeros = nbManaHeros - coutManaSort;
        if(nbManaHeros >=0 && nbPvMonstre >0){
            forceHeros = forceHeros + forceSort;
            affichageForce.textContent = forceHeros;
            affichageManaHeros.textContent = nbManaHeros;
        }
        else{
            nbManaHeros =0;
            affichageLog.textContent = "Vous n'avez plus assez de mana pour jeter un sort";
        }
    }

    //Le monstre lance un sort de force
    function monstreLancerSortForce(){
        manaMonstre = manaMonstre - coutManaSort;
        if(manaMonstre >=0 && nbPvMonstre >0){
            forceMonstre = forceMonstre + forceSort;
            affichageForce.textContent = forceMonstre;
        }
        else{
            manaMonstre =0;
            affichageLog.textContent = "Le monstre n'a plus assez de mana pour jeter un sort";
        }
    }

    //Lance un sort qui redonne du mana

    function lancerSortMana(){
        nbManaHeros = nbManaHeros - coutManaSort;
        if(nbManaHeros >=0 && nbPvHeros >0){
            nbManaHeros = nbManaHeros + manaSort;
            affichageManaHeros.textContent = nbManaHeros;
        }
        else{
            nbManaHeros =0;
            affichageLog.textContent = "Vous n'avez plus assez de mana pour jeter un sort";
        }
    }

    /*Lance une potion de soin*/

    function lancerPotionSoin(){
        if(nbPotionSoin > 0 && nbPvHeros >0){
            nbPotionSoin = nbPotionSoin -1;
            nbPvHeros = nbPvHeros + soinPotion;
            boutonPotionSoin.textContent = nbPotionSoin + " : Potion de soin : " +  soinPotion + "pv";
            affichagePvHeros.textContent = nbPvHeros;
        }
        else{
            affichageLog.textContent = "Vous n'avez plus de potion de soin";
        } 
    }

    /*Lance une potion de force*/

    function lancerPotionForce(){
        if(nbPotionForce > 0 && nbPvHeros >0){
            nbPotionForce = nbPotionForce -1;
            forceHeros = forceHeros + forcePotion;
            affichageForce.textContent = forceHeros;
            boutonPotionForce.textContent = nbPotionForce + " : Potion de force : " +  forcePotion;
        }
        else{
            affichageLog.textContent = "Vous n'avez plus de potion de force";
            
        } 
    }

    /*Lance une potion de mana*/
    function lancerPotionMana(){
        if(nbPotionMana > 0 && nbPvHeros >0){
            nbPotionMana = nbPotionMana -1;
            nbManaHeros = nbManaHeros + manaPotion;
            affichageManaHeros.textContent = nbManaHeros;
            boutonPotionMana.textContent = nbPotionMana + " : Potion de mana : " +  manaPotion;
        }
        else{
            affichageLog.textContent = "Vous n'avez plus de potion de mana";
        } 
    }

    /* retourne vrai si le héros gagne */
    function estgagnee(){
        if(nbPvHeros > 0 && nbPvMonstre == 0){
            return true;
        }
        return false;
    }

    /*retourne vrai si le héros perd*/
    function estperdu(){
        if(nbPvHeros == 0){
            return true;
        }
        else{
            return false;
        }
    }
    
    /******  début du programme ******/

    /*lien affichage et valeur*/
    

       
        boutonAttaque.addEventListener('click', ()=>{
            attaqueSimple();
        });

        boutonSortEmpoisonnement.addEventListener('click', ()=>{
        
            lancerSortEmpoisonnement();
        })

        boutonSortForce.addEventListener('click', ()=>{
            lancerSortForce();
        })

        boutonSortMana.addEventListener('click', ()=>{
            lancerSortMana();
        })

        boutonSortSoin.addEventListener('click', ()=>{
            lancerSortSoin();
        })

        boutonPotionSoin.addEventListener('click', ()=>{
            lancerPotionSoin();
        })

        boutonPotionMana.addEventListener('click', ()=>{
            lancerPotionMana();
        })
        boutonPotionForce.addEventListener('click', ()=>{
            lancerPotionForce();
        })

    


