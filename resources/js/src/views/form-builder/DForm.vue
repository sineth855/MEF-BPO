<template>
    <div>
        <template>
            <div :key="i" v-for="(formAttribute, i) in formAttributes">
                <div v-if="formAttribute.type == 'text'">
                    <d-form-input :formAttribute="formAttribute"></d-form-input>
                </div>
            </div>
        </template>
        <span class="pull-right">
            <vs-button type="filled" @click.prevent="submitForm" class="mt-5 block">{{$t("btn_save")}}</vs-button>
        </span>
    </div>
</template>

<script>
    import DFormInput from '@/views/form-builder/form-control/DFormInput.vue'
    export default {
        props: {
            formAttributes: {
                required: true
            },
        },
        components: {
            DFormInput  
        },
        methods: {
            submitForm() {
                console.log("field name", );
                this.$validator.validateAll().then(result => {
                    if (result) {
                        this.$vs.notify({
                            title: 'Icon mail',
                            text: 'Lorem ipsum dolor sit amet, consectetur',
                            color: 'success',
                            iconPack: 'feather',
                            icon: 'icon-check',
                            position: 'top-right'
                        });
                        // this.showObjective = false;
                    } else {
                        // form have errors
                    }
                })
            }
        },   
    }
</script>