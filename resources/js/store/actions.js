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

        Axios.get('/api/user/getuserprofileimage', headers).then(resp => {
            console.log(resp);
            if (resp.data.success) {
                this.state.userImage = resp.data.success.image;
            } else {
                this.state.userImage = '';
            }
        })
    },
    getUserBGImage({
        commit
    }) {
        let headers = {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.state.userToken}`
            }
        };

        Axios.get('/api/user/getuserbgimage', headers).then(resp => {
            console.log(resp);
            if (resp.data.user_bg_image) {
                this.state.userBGImage = resp.data.user_bg_image;
            } else {
                this.state.userBGImage = '/images/default_bg_image.jpg';
            }
        })
    },
    setUserBGImage({ commit },
        payload
    ) {
        let headers = {
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${this.state.userToken}`
            }
        };

        Axios.post('/api/user/setuserbgimage', payload, headers).then(resp => {
            // if (resp.data.user_bg_image) {
            //     this.state.userBGImage = resp.data.user_bg_image;
            // } else {
            //     this.state.userBGImage = '/images/default_bg_image.jpg';
            // }
        })
    }
}