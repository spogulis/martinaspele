<template>
     <div class="app-wrapper">
        <NavBar
            :nav-links="navLinks"
            @showOverlay="onShowOverlay"
            class="navbar-wrapper"
        />

        <LoginModal
            class="login-modal-wrapper"
            v-if="checkLoginModalVisible"
        />

        <RegisterModal
            class="register-modal-wrapper"
            v-if="checkRegisterModalVisible"
        />

        <PleaseLoginModal
            class="please-login-modal-wrapper"
            v-if="checkPleaseLoginModalVisible"
        />

        <main>
            <router-view></router-view>
        </main>
        <div ref="overlay" class="overlay"></div>
     </div>
</template>

<script>
import { mapState } from 'vuex';
import NavBar from '@/components/NavBar';
import LoginModal from '@/components/LoginModal';
import RegisterModal from '@/components/RegisterModal';
import PleaseLoginModal from '@/components/PleaseLoginModal';

export default {
    components: {
        NavBar,
        LoginModal,
        RegisterModal,
        PleaseLoginModal
    },
    data: function() {
        let navLinks = [
            {
                path: '/',
                name: 'HOME'
            },
            {
                path: '/about',
                name: 'ABOUT'
            },
            {
                path: '/',
                name: 'REGISTER'
            },
            {
                path: '/verify',
                name: 'VERIFY'
            }
        ];

        let isLoggedIn = null;
        let name =  null;

        return { navLinks, isLoggedIn, name };
    },
    methods: {
        onShowOverlay (value) {
            value === true ? this.$refs.overlay.classList.add('active') : this.$refs.overlay.classList.remove('active');
        },
    },
    beforeMount(){
        let email = localStorage.getItem('user');
        let token = localStorage.getItem('jwt');

        if (email && token) {
            this.$store.state.loggedInUser = email;
            this.$store.state.isLoggedIn = true;
            this.$store.state.userToken = token;
        }
        else {
            this.$store.state.isLoggedIn = false;
        }
    },
    computed: {
        checkLoginModalVisible() {
            return this.$store.state.loginModalVisible;
        },
        checkRegisterModalVisible() {
            return this.$store.state.registerModalVisible;
        },
        checkPleaseLoginModalVisible() {
            return this.$store.state.pleaseLoginModalVisible;
        },
        shouldHideNav() {
            return this.$store.state.hideNav;
        },
    },
    created() {
        window.addEventListener(
            'resize', () =>
            {
                this.$store.commit('setWindowWidth')
            }
        )
    },
    destroyed() {
        window.removeEventListener(
            'resize', () =>
            {
                this.$store.commit('setWindowWidth')
            }
        )
    },
}
</script>

<style lang="scss" scoped>
    main {
        height: 100vh;
        z-index: 997;
    }

    .app-wrapper {
        justify-content: center;
    }

    .navbar-wrapper {
        z-index: 998;
    }
    .navbar-laravel {
        display: none;
    }
    #sidebar {
        min-width: 250px;
        max-width: 250px;
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 9999;
        background: black;
    }
    #dismiss {
        width: 35px;
        height: 35px;
        position: absolute;
        top: 10px;
        right: 10px;
    }
    .overlay {
        display: block;
        position: fixed;
        width: calc(100vw - 350px);
        right: calc((100vw - 350px) * -1);
        height: 100vh;
        background: rgba(0, 0, 0, 0.7);
        z-index: 998;
        opacity: 0;
        transition: all 0.9s ease-in-out;
    }
    .overlay.active {
        right: 0;
        opacity: 0.2;
    }
    .login-modal {
        justify-content: center;
    }
</style>
