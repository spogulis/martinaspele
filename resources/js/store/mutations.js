export default {
    login(state, isLoggedIn) {
        state.isLoggedIn = isLoggedIn
        console.log('login from mutations')
    },

    toggleLoginModalVisibleState(state) {
        state.loginModalVisible = !state.loginModalVisible;
    },
    toggleLoginBtnVisibleState(state) {
        state.loginBtnVisible = !state.loginBtnVisible;
    }
}