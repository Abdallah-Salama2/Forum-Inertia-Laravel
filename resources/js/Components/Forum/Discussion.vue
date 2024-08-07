<script setup>
import {Link} from '@inertiajs/vue3';
import {route} from "ziggy-js";
import {computed} from "vue";
import {pl} from "vuetify/locale";
import pluralize from "pluralize";

const props = defineProps({
    discussion: Object
})
// by making participants computed we can limit them control them
const participants = computed(() => props.discussion.participants.slice(0, 3));
</script>

<template>
    <Link :href="route('discussion.show',discussion) " class="block bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex items-center  space-x-6">
            <div class="flex-grow">
                <div class="flex items-center space-x-3">
                    <span
                        class="inline-flex items-center rounded-lg bg-gray-100 px-3 py-0.5 text-sm text-gray-600">{{
                            discussion.topic.title
                        }}</span>
                    <h1 class="text-lg font-medium">
                        <template v-if="discussion.is_pinned">
                            [Pinned]
                        </template>
                        {{ discussion.title }}
                    </h1>
                </div>
                <div v-if="discussion.post" class="text-gray-500 text-sm mt-5 line-clamp-1">
                    {{ discussion.post.body_preview }}
                </div>
                <Link v-if="discussion.latest_post" :href="route('discussion.show',discussion)"
                      class="text-sm mt-6  inline-block">
                    Last Post By {{ discussion.latest_post.user?.username || '[user deleted]' }}
                    <time :datetime="discussion.latest_post.created_at.datetime"
                          :title="discussion.latest_post.created_at.datetime">
                        {{ discussion.latest_post.created_at.human }}
                    </time>
                </Link>
            </div>
            <div class="flex-shrink-0">
                <!--                -space-x-1 make images overlap -->
                <div class="flex items-center space-x-1">
                    <img :src="participant.avatar_url" alt="" v-for="participant in participants"
                         :key="participant.id"
                         class="h-6 w-6 rounded-full ring-2 ring-white first-of-type:w-8 first-of-type:h-8"
                         :title="participant.username"
                    >
                    <span class="!ml-1 text-sm"
                          v-if="discussion.participants.length>3"> + {{
                            discussion.participants.length - 3
                        }} more</span>

                </div>
                <div class="text-sm mt-3 flex items-end"> {{ pluralize('reply', discussion.replies_count, true) }}
<!--                    for 2 replies and 1 reply sentence-->
                </div>

            </div>
        </div>
    </Link>
</template>

<style scoped>

</style>
