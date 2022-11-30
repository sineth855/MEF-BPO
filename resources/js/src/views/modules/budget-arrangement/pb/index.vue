<!-- =========================================================================================
    File Name: FormWizard.vue
    Description: Form Wizard (third-party) - Imports page portions
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->

<template>
    <div id="extra-component-form-wizard-demo">
        <form-wizard-validation></form-wizard-validation>
    </div>
</template>

<script>
import FormWizardValidation from "./FormWizardValidation.vue"

export default {
    components: {
        FormWizardValidation,
    }
}
</script>
