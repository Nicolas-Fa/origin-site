import {CLIENT_ID, CLIENT_SECRET} from "./vars.js";

export async function fetchCharacterInfo(royaume, pseudo) {
    const authResponse = await fetch("https://oauth.battle.net/token", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `grant_type=client_credentials&client_id=${CLIENT_ID}&client_secret=${CLIENT_SECRET}`,
    });
    if (authResponse.ok) {
        const data = await authResponse.json();
    
    var access_token = data.access_token

    const response = await fetch(
        `https://eu.api.blizzard.com/profile/wow/character/${royaume}/${pseudo}/appearance?namespace=profile-eu&locale=fr_FR`, {
            headers: {Authorization: `Bearer ${access_token}`},
        }
    );
    
    if (!response.ok) {
        throw new Error(`Erreur API : ${response.status}`);
    }
    ;
    const characterInfo = await response.json();
    
    return characterInfo;
}}