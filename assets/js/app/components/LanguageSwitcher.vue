<template>
    <div class="language" @click="changeLocale">
        <input type="checkbox" class="checkbox">
        <div class="lan_switch1">
            <span>EN</span>
        </div>
        <!-- <div class="lan_switch2">RU</div> -->
    </div>
</template>

<script>
    export default {
        methods:{
            changeLocale(){
                if(this.$i18n.locale === 'ua')
                    this.$i18n.locale = 'en';
                else
                    this.$i18n.locale = 'ua';
            }
        }
    }
</script>

<style scoped>

</style>