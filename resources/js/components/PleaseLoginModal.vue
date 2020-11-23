<template>
    <div ref="please-login-modal-wrapper">
        <div class="please-login-modal">
            <h3>Please log in and reopen the email verification link.</h3>
            <div class="btn-wrapper">
                <button
                    class="btn btn-secondary"
                    @click="handleOk"
                >OK</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            handleOk(e){
                this.$store.commit('toggleLoginPromptVisibleState');
                this.$store.commit('toggleLoginModalVisibleState');
            }
        }
    }
</script>

<style scoped lang="scss">
    @import '~/abstracts/_mixins.scss';

    label {
        font-size: 20px;
    }

    h1 {
        display: inline-block;
        color: white;
    }

    .btn-wrapper {
        align-self: center;

        .btn {
            padding: 0 20px;
        }
    }

    .please-login-modal-wrapper {
        width: 78%;
        top: 40px;
        position: fixed;
        z-index: 999;
        display: flex;
        flex-direction: column;

        @media #{$tabletPortrait} {
            width: 500px;
        }
    }

    .please-login-modal {
        background: black;
        color: white;
        opacity: 70%;
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        padding: 20px;
    }

    .title-wrapper {
        justify-content: center;
        display: flex;
        margin: 20px 0 70px;
    }


    .button-wrapper {
        display: flex;
        justify-content: space-around;
        margin: 20px 0 20px 0;
    }
</style>
