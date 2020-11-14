export default {
    login(state, isLoggedIn) {
        state.isLoggedIn = isLoggedIn
    },
    setWindowWidth(state) {
        state.windowWidth = window.innerWidth;
    },
    toggleLoginModalVisibleState(state) {
        state.loginModalVisible = !state.loginModalVisible;
    },
    toggleLoginBtnVisibleState(state) {
        state.loginBtnVisible = !state.loginBtnVisible;
    },
    toggleLogoutBtnVisibleState(state) {
        state.logoutBtnVisible = !state.logoutBtnVisible;
    },
    toggleLoginEmailVisibleState(state) {
        state.loginEmailVisible = !state.loginEmailVisible;
    }
}