
    let affichagePvHeros = document.getElementById('pv_heros');
    let affichagePvMonstre = document.getElementById('pv_monstre');
    let affichageManaHeros = document.getElementById('mana_heros');
    let boutonSortEmpoisonnement = document.getElementById('sort_empoisonnement');
    let boutonSortSoin = document.getElementById('sort_soin');
    let boutonSortForce = document.getElementById('sort_force');
    let boutonSortMana = document.getElementById('sort_mana');
    let boutonPotionSoin = document.getElementById('potion_soin');
    let boutonPotionForce = document.getElementById('potion_force');
    let boutonPotionMana = document.getElementById('potion_mana');
    let boutonAttaque = document.getElementById('attaque');
    let nomMonstre = document.getElementById('nom_monstre');
    let affichageForce = document.getElementById('force_heros');
    let affichageLog = document.getElementById('affichage_log');

    /**** caractéristique héros ****/

    let nbPvHeros = 300;
    let forceHeros = 20;
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


   /* document.addEventListener('DOMContentLoaded', () => {
        // Les données sont déjà disponibles
        const fight = new FightSystem(heroData, monsterData);
        fight.init();
    });
  
    nomMonstre.textContent = fight.name;*/
      
  /**** fonctions ****/  

 //Lance une attaque simple sur le monstre
    function attaqueSimple(){
        if(nbPvMonstre > 0 && nbPvHeros >0){
        pvRestant = nbPvMonstre - forceHeros;
        if(pvRestant < 0){
            pvRestant = 0;
        }
        affichagePvMonstre.textContent = pvRestant;
        nbPvMonstre = pvRestant;
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

    //Lance un sort qui augmente la force

    function lancerSortForce(){
        nbManaHeros = nbManaHeros - coutManaSort;
        if(nbManaHeros >=0 && nbPvHeros >0){
            forceHeros = forceHeros + forceSort;
            affichageForce.textContent = forceHeros;
            affichageManaHeros.textContent = nbManaHeros;
        }
        else{
            nbManaHeros =0;
            affichageLog.textContent = "Vous n'avez plus assez de mana pour jeter un sort";
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
    affichagePvHeros.textContent = nbPvHeros;
    affichageManaHeros.textContent = nbManaHeros;
    affichagePvMonstre.textContent = nbPvMonstre;
    affichageForce.textContent = forceHeros;
    boutonPotionForce.textContent = nbPotionForce + " : Potion de force : " +  forcePotion;
    boutonPotionSoin.textContent = nbPotionSoin + " : Potion de soin : " +  soinPotion + "pv"; 
    boutonPotionMana.textContent = nbPotionMana + " : Potion de mana : " +  manaPotion;
    nomMonstre.textContent = "Le loup noir";

    
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
        

