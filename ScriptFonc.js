function intToMonth(a){
    a=parseInt(a);
    switch(a){
        case 1:
        return "Janvier";
        case 2:
        return "Fevrier";
        case 3:
        return "Mars";
        case 4 :
        return "Avril";
        case 5 :
        return "Mai";
        case 6 : 
        return "Juin";
        case 7 : 
        return "Juillet";
        case 8 :
        return "Aout";
        case 9 :
        return "Septembre";
        case 10:
        return "Octobre";
        case 11:
        return "Novemnbre";
        case 12 :
        return "Decembre";
        default :
        return "erreur";
    }
}