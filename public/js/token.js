import {CLIENT_ID, CLIENT_SECRET} from "./env";

export async function fetchCharacterInfo() {
    const authResponse = await fetch("https://oauth.battle.net/token", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `grant_type=client_credentials&client_id=${CLIENT_ID}&client_secret=${CLIENT_SECRET}`,
    });

    const {access_token} = await authResponse.json();

    const response = await fetch(
        `https://eu.api.blizzard.com/profile/wow/character/${royaume}/${pseudo}/appearance?namespace=profile-eu&locale=fr_FR`, {
            headers: {Authorization: `Bearer ${access_token}`},
        }
    );

    const characterInfo = await response.json();
    return characterInfo;
}