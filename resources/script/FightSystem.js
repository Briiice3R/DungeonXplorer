
    let affichagePvHeros = document.getElementById('pv_heros');
    let nbPvHeros = 300;
    let nbPvMonstre = 500;
    let PvMonstre = document.getElementById('pv_monstre');
    let affichageManaHeros = document.getElementById('mana_heros');
    let boutonSortEmpoisonnement = document.getElementById('sort_empoisonnement');
    let boutonSortSoin = document.getElementById('sort_soin');
    let boutonSortAttaque = document.getElementById('sort_attaque');
    let boutonSortMana = document.getElementById('sort_mana');
    let boutonPotionSoin = document.getElementById('potion_soin');
    let boutonPotionForce = document.getElementById('potion_force');
    let boutonPotionMana = document.getElementById('potion_mana');
    let boutonAttaque = document.getElementById('attaque');
    let nomMonstre = document.getElementById('nom_monstre');
    let dommageSort = 30; 
    let forceHeros = 20;
    let initiativeHeros = 30;
    let niveauHeros = 1;
    let nbPotionSoin = 3;
    let nbPotionAttaque = 2;
    let nbPotionMana = 1;
    let coutMana = 10;
    let nbManaHeros = 100;
    document.addEventListener('DOMContentLoaded', () => {
        // Les données sont déjà disponibles
        const fight = new FightSystem(heroData, monsterData);
        fight.init();
    });
  
    nomMonstre.textContent = fight.name;
      
  /*fonctions*/  

 //Lance une attaque simple sur le monstre
    function attaqueSimple(){
        if(nbPvMonstre > 0){
        pvRestant = nbPvMonstre - forceHeros;
        if(pvRestant < 0){
            pvRestant = 0;
        }
        affichagePvMonstre.textContent = pvRestant + 'PV';
        nbPvMonstre = pvRestant;
        
            
        }
    }

    //Lance un sort d'empoisonnement

    function lancerSortEmpoisonnement(){
        nbManaHeros = nbManaHeros - coutMana;
        if(nbManaHeros >=0 && nbPvMonstre >0){
            pvRestant = nbPvMonstre - dommageSort;
            if(nbPvMonstre <0){
                pvRestant =0;
            }
            affichagePvMonstre.textContent = pvRestant + 'PV';
            affichageManaHeros.textContent = nbManaHeros;
        }
        else{
            alert("Vous n'avez plus assez de mana pour jeter un sort");
        }
    }
    
    /* début du programme */
   /* affichagePvHeros.textContent = '300 PV';
    nomMonstre.textContent = "Le loup noir";
    boutonAttaque.addEventListener('click', ()=>{
        attaqueSimple();
    });

    boutonSortEmpoisonnement.addEventListener('click', ()=>{
        
        lancerSortEmpoisonnement();
    })*/
        
