<p class="subtitle is-5 is-spaced">
    Personas a su cargo
</p>
<hr>
<v-table-team :vdata="{{ json_encode($user->vteam()->get()) }}">
</v-table-team>