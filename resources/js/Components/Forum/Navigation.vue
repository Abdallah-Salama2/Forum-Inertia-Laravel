<script setup>
import {Link} from '@inertiajs/vue3'

defineProps(
    {
        query: Object,
    })
</script>

<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <nav>
                <ul>
                    <li>
                        <Link href="/" :class="{'font-bold': !query.filter && $page.component =='Forum/Index'  }">All
                            discussions
                        </Link>
                        <!--                        <Link href="/" :class="{'font-bold': !query.filter && $page.url =='/'  }">All discussions</Link>-->
                    </li>
                    <li>
                        <Link href="/?filter[noreplies]=1" :class="{'font-bold':query.filter?.noreplies}">No replies
                        </Link>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<style scoped>

</style>
