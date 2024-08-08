<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import ForumLayout from "@/Layouts/ForumLayout.vue";
import Select from "@/Components/Select.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Discussion from "@/Components/Forum/Discussion.vue";
import {definePosition} from "@meforma/vue-toaster/src/defaults/positions.js";
import Pagination from "@/Components/Pagination.vue";
import Navigation from "@/Components/Forum/Navigation.vue";

defineProps({
    discussions: Object
})
</script>

<template>
    <Head title="Dashboard"/>

    <ForumLayout>
        <!--  <template #side> it will detect the slot with name side-->

        <template #side>
            <Navigation></Navigation>
        </template>
        <!--  right in forumn layout-->
        <div class="space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <InputLabel for="topic" class="sr-only ">Topic</InputLabel>
                        <Select id="topic">
                            <option value="">All topics</option>
                            <option :value="topic.slug" v-for="topic in $page.props.topics" :key="topic.id">
                                {{ topic.title }}
                            </option>
                        </Select>
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                <template v-if="discussions.data.length">
                    <Discussion v-for="discu in discussions.data " :key="discu.id" :discussion="discu"/>
                    <Pagination :pagination="discussions.meta"/>
                </template>

            </div>
        </div>
    </ForumLayout>
</template>
