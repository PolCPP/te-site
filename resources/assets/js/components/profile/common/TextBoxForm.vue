<template>
    <div class="form-group" v-bind:class="{ 'alert alert-danger': has_error, 'hidden-type': input_type == 'hidden' }">
        <!-- <label :for="generateFieldId()">{{label}}</label> -->
        <input v-if="input_type == 'text'" type="text" class="form-control" :id="generateFieldId()" :name="generateFieldName()"
            :placeholder="parsedPlaceholder" v-model="value" @input="onInput" @blur="onBlur" :readonly="readonly" :required="required" :minlength="minlength"/>
        <input v-if="input_type == 'email'" type="email" class="form-control" :id="generateFieldId()" :name="generateFieldName()"
            :placeholder="parsedPlaceholder" v-model="value" @input="onInput" @blur="onBlur" :readonly="readonly" :required="required" :minlength="minlength"/>
        <input v-if="input_type == 'password'" type="password" class="form-control" :id="generateFieldId()" :name="generateFieldName()"
            :placeholder="parsedPlaceholder" v-model="value" @input="onInput" @blur="onBlur" :readonly="readonly" :required="required" :minlength="minlength"/>
        <input v-if="input_type == 'hidden'" type="hidden" class="form-control" :id="generateFieldId()" :name="generateFieldName()"
            :placeholder="parsedPlaceholder" v-model="value"/>

        <span v-if="has_error" class="help-block">
            <strong>{{error_message}}</strong>
        </span>
    </div>
</template>

<script>
import { parsedPlaceholder, setDebounced, setCodeForValidation, setInitError, generateFieldId, generateFieldName, validateField, onInput, onBlur } from './form-helpers'

export default {
    props: ['code', 'groupCode', 'groupId', 'label', 'placeholder', 'type', 'value', 'minlength', 'readonly', 'required', 'errors', 'noValidate'],
    data() {
        return {
            'input_type': this.type || 'text',
            'has_error': false,
            'error_message': null
        }
    },
    created() {
        setDebounced.call(this);
        setCodeForValidation.call(this);
        setInitError.call(this);
    },
    computed: {
        parsedPlaceholder: parsedPlaceholder
    },
    methods: {
        validateField: validateField,
        generateFieldId: generateFieldId,
        generateFieldName: generateFieldName,
        onInput: onInput,
        onBlur: onBlur,
    }
};
</script>

<style lang="sass" scoped>
.form-group.hidden-type {
    margin: 0;
}
</style>
