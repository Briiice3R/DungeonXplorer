const inputInventoryField = document.getElementById("inventoryDataField");
inputInventoryField.style.display = 'none';

const equipped = {
    left: null,
    right: null,
    armor: null
};

document.querySelectorAll('.equipment-button').forEach(button => {
    button.addEventListener("click", (event) => {
        const clickedButton = event.currentTarget;
        const emplacement = clickedButton.dataset.equipmenttype;
        if(clickedButton.classList.contains("active")){
            clickedButton.classList.remove("active");
        } else {
            document.querySelectorAll('.equipment-button').forEach(btn => {
                if(emplacement==btn.dataset.equipmenttype){
                    btn.classList.remove("active");
                }
            })
            clickedButton.classList.add("active");
        }
        equipped.left = null;
        equipped.right = null;
        equipped.armor = null;
        document.querySelectorAll('.equipment-button').forEach(btn => {
            if(btn.classList.contains("active")){
                const type = btn.dataset.equipmenttype;
                const itemId = btn.closest(".item-card").dataset.itemid;
                console.log(type);
                console.log("itemId:"+itemId);
                console.log(equipped);
                switch(type) {
                    case "left":
                        equipped.left = itemId;
                        break;
                    case "right":
                        equipped.right = itemId;
                        break;
                    case "armor":
                        equipped.armor = itemId;
                        break;
                }
            }
        });
        inputInventoryField.value = 'Left: ' + equipped.left + ' Right: '+ equipped.right + ' Armor: ' + equipped.armor;
        console.log(inputInventoryField.value);

        document.querySelectorAll('.equipment-button').forEach(button => {
            if(button.classList.contains("active")){
                button.classList.add("bg-[#C4975E]");
                button.classList.remove("bg-[#C4975E]/10");
            } else {
                button.classList.add("bg-[#C4975E]/10");
                button.classList.remove("bg-[#C4975E]");
            }
        });
    });
});
