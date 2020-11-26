import Axios from "axios"
import { bindAll } from "lodash";

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
    getUserGeneralLevel({
        commit
    }) {
        let headers = {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.state.userToken}`
            }
        };

        Axios.get('/api/user/getgenerallevel', headers).then(resp => {
            this.state.userGeneralLevel = resp.data.current_level;
        })
    },
    getUserImage({
        commit
    }) {
        let headers = {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.state.userToken}`
            }
        };

        Axios.get('/api/user/getuserimage', headers).then(resp => {
            if (resp.data.user_image) {
                this.state.userImage = resp.data.user_image;
            } else {
                this.state.userImage = '';
            }
        })
    }
}