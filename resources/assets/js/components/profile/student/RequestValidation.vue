<template>
    <div class="row">
        <h4 class="col-sm-12">{{ $t('reg-profile.find_your_academic_institution') }}</h4>

        <div class="col-sm-6">
            <select-form code="country" :label="$t('reg-profile.country')" :placeholder="' - ' + $t('reg-profile.country') + ' - '" required :values="countries" :value="country" no-validate>
            </select-form>
        </div>
        <div class="col-sm-6">
            <autocomplete code="institution" :items="institutions" :placeholder="$t('reg-profile.student_study_institution_name')" only-matches="true" open-on-click="true" :disabled="isInstitutionsDisabled" no-validate required>
            </autocomplete>
        </div>

        <div class="form-group col-sm-12">
            <label for="referee">{{ $t('reg-profile.choose_referee') }}</label>
            <select-form code="referee" label="Referee" :placeholder="' - ' + $t('reg-profile.any_referee') + ' - '" :parsed-values="referees" :disabled="isRefereesDisabled" no-validate>
            </select-form>
        </div>
        <hr>
        <p class="col-sm-12 text-right">
            <button type="submit" class="btn btn-primary">{{ $t('reg-profile.refer_request') }}</button>
        </p>
    </div>
</template>

<script>
import SelectForm from '../common/SelectForm.vue';
import TextBoxForm from '../common/TextBoxForm.vue';
import Autocomplete from './common/Autocomplete.vue';
import { institutionResource, refereeResource } from 'resources/profile';
import { defaultErrorToast } from 'errors-handling.js';
import EventBus from 'event-bus.js';

export default {
    props: ['countries'],
    components: { TextBoxForm, SelectForm, Autocomplete },
    data() {
        return {
            'institutions': [],
            'referees': {}
        };
    },
    ready() {
        EventBus.$on('onSelectChange-country', (country_key) => {
            this.institutions = [];
            if (!country_key == '') {
                institutionResource.get(country_key)
                    .then((response) => {
                        this.institutions = response.body;
                    }, (errorResponse) => {
                        defaultErrorToast();
                    })
            }
        });
        EventBus.$on('onAutocompleteChange-institution', (institution) => {
            this.referees = {};
            if (!_.isNull(institution)) {
                refereeResource.get(institution.id)
                    .then((response) => {
                        var _referees_obj = {};
                        response.body.forEach(function(value_obj) {
                           _referees_obj[value_obj["id"]] = `${value_obj["name"]} (${value_obj["department"]}, ${value_obj["position"]})`;
                        });
                        this.referees = _referees_obj;
                    }, (errorResponse) => {
                        defaultErrorToast();
                    })
            }
        });
    },
    computed: {
        isInstitutionsDisabled() {
            return this.institutions.length == 0;
        },
        isRefereesDisabled() {
            return _.isEmpty(this.referees);
        }
    }
};
</script>

<style lang="sass" scoped>
</style>
