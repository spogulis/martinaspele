import Axios from "axios"

export default {
    logout({
        commit
    }) {
        let headers = {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.state.userToken}`
            }
        };

        Axios.get('/api/user/logout', headers).then(Response => {
            this.state.isLoggedIn = false;
            localStorage.clear();

            if (!this.state.loginBtnVisible) {
                this.commit('toggleLoginBtnVisibleState');
            }

            if (this.state.logoutBtnVisible) {
                this.commit('toggleLogoutBtnVisibleState');
            }

            if (this.state.loginModalVisible) {
                this.commit('toggleLoginModalVisibleState');
            }

            if (this.state.loginEmailVisible) {
                this.commit('toggleLoginEmailVisibleState');
            }
        })
    },
    loginIfTokenExists({
        commit
    }) {
        let headers = {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.state.userToken}`
            }
        };
    }
}