import { handleUserAuthenctication, isUserAuthenticated } from "./imports/auth.js";
import { initPageSlider, initThemeChanger } from "./imports/slider.js";
import { getUserTasks, loadCompletedUserTasks, loadHomeUserTasks } from "./imports/tasks.js";
import { initProffileAction } from "./imports/user.js";

async function setUpApplication() {
    initPageSlider();
    initThemeChanger();

    console.log(await isUserAuthenticated() ? 'user authenticated' : 'no user authenticated');

    initProffileAction();
    
    loadHomeUserTasks();
    loadCompletedUserTasks();
}

setUpApplication();