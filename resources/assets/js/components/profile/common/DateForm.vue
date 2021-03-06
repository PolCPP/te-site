<template>
    <div class="form-group" v-bind:class="{ 'alert alert-danger': has_error }">
        <label :for="generateFieldId()">{{ parsedLabel }}</label>
        <input class="form-control" type="date" :id="generateFieldId()" :name="generateFieldName()"
            :placeholder="placeholder" :value="value" :required="required" :readonly="readonly"/>

        <span v-if="has_error" class="help-block">
            <strong>{{error_message}}</strong>
        </span>
    </div>
</template>

<script>
import { parsedLabel, setDebounced, setCodeForValidation, setInitError, generateFieldId, generateFieldName, validateField, onInput } from './form-helpers';

export default {
    props: ['code', 'groupCode', 'groupId', 'label', 'placeholder', 'value', 'readonly', 'required', 'errors', 'noValidate'],
    data() {
        return {
            'has_error': false,
            'error_message': null
        }
    },
    created() {
        this.$nextTick(function () {
            if (this.readonly) {
                return;
            }
            this.datepicker = document.getElementById(this.generateFieldId()).flatpickr({
                altInput: true,
                altFormat: 'd/m/Y',
                altInputClass: 'form-control',
                allowInput: true,
                onReady: (selectedDates, dateStr, instance) => {
                    $(instance.altInput).keydown(function(event) {
                        event.preventDefault();
                    });

                    if (!_.isUndefined(this.required)) {
                        instance.altInput.required = true;
                    }
                },
                onChange: (selectedDates, dateStr, instance) => {
                    this.value = dateStr;
                },
            });
        });

        setDebounced.call(this);
        setCodeForValidation.call(this);
        setInitError.call(this);
    },
    computed: {
        parsedLabel: parsedLabel
    },
    methods: {
        validateField: validateField,
        generateFieldId: generateFieldId,
        generateFieldName: generateFieldName,
    },
    watch: {
        value: onInput
    }
};
</script>
