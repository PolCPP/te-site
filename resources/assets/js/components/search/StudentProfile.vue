<template>
    <li class="well profile clearfix">
        <div>
            <div class="col-xs-12 col-sm-8 col-md-9">
                <h2 class="title"><a :href="seeMoreUrl">{{student.full_name}}</a></h2>
                <p><em class="h4">{{student.studied}}</em></p>
                <hr>
                <p><strong><i class="fa fa-map-marker"></i> {{ $t('reg-profile.lives_in') }}: </strong> {{student.lives_in}}</p>
                <p><strong>{{ $t('reg-profile.studied_in') }}: </strong> {{student.studied_in}}</p>
                <p v-if="student.skills.length > 0">
                    <strong>{{ $t('reg-profile.skilled_in') }}: </strong>
                    <skills-tags :skills="student.skills"></skills-tags>
                </p>
                <p v-if="student.languages.length > 0"><strong>{{ $t('reg-profile.student_languages') }}: </strong>
                    <ul class="languages">
                        <li v-for="language in student.languages" track-by="$index">{{language}}</li>
                    </ul>
                </p>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3 text-center">
                <figure>
                    <img :src="student.photo" alt="" class="img-circle img-responsive">
                    <figcaption class="ratings" v-if="student.validated == 'validated'">
                        <span class="label label-success">
                            <i class="fa fa-star"></i> {{ $t('search.refereed') }}
                        </span>
                    </figcaption>
                </figure>
                <a class="btn-primary btn view-more" :href="seeMoreUrl">{{ $t('global.more_btn') }}</a>
            </div>
        </div>
    </li>
</template>

<script>
import SkillsTags from '../common/SkillsTags.vue'

export default {
    components: {
        'skills-tags': SkillsTags,
    },
    props: ['student'],
    computed: {
        seeMoreUrl: function () {
            return TE.logged_in ? `/profile/${this.student.slug}/${this.student.id}` : '/register?see_more=1';
        }
    }
}
</script>

<style lang="sass" scoped>
@import "resources/assets/sass/components/site/search-profile.scss";
</style>
