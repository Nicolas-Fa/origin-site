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

    const mediaData = await fetch(
        `https://eu.api.blizzard.com/profile/wow/character/${royaume}/${pseudo}/character-media?namespace=profile-eu&locale=fr_FR&${access_token}`, {
            headers: {Authorization: `Bearer ${access_token}`},
        }
    );
    const characterInfo = await fetch(
        `https://eu.api.blizzard.com/profile/wow/character/${royaume}/${pseudo}/appearance?namespace=profile-eu&locale=fr_FR&${access_token}`, {
            headers: {Authorization: `Bearer ${access_token}`},
        }
    );
    
    if (!characterInfo.ok) {
        throw new Error(`Erreur API : ${characterInfo.status}`);
    }
    if (!mediaData.ok) {
        throw new Error(`Erreur API : ${mediaData.status}`);
    }
    ;
    const character = await characterInfo.json();
    const media = await mediaData.json();
    
    return {character, media}
}}