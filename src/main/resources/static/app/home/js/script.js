import { handleUserAuthenctication, isUserAuthenticated } from "./imports/auth.js";
import { initPageSlider } from "./imports/slider.js";
import { getUserTasks, loadCompletedUserTasks, loadHomeUserTasks } from "./imports/tasks.js";
import { initProffileAction } from "./imports/user.js";


async function setUpApplication() {
    initPageSlider();
    console.log(await isUserAuthenticated());
    if (await isUserAuthenticated()) {
        initProffileAction();
        loadHomeUserTasks();
        loadCompletedUserTasks();
    } else {
        handleUserAuthenctication();
    }
}

setUpApplication();