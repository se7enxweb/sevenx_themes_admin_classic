{* SevenX Themes Admin Classic - Switch Admin Design toolbar template *}
{* Renders a form in the admin right toolbar to toggle between admin3 and admin_classic designs *}

{def $switchadmindesign_info = fetch( 'switchadmindesign', 'current_design', hash() )
     $switchadmindesign_is_classic = $switchadmindesign_info.is_classic
    $switchadmindesign_current_uri = cond(
        ezhttp_hasvariable( 'LastAccessesURI', 'session' ),
        ezhttp( 'LastAccessesURI', 'session' ),
        concat( '/', $module_result.uri )
    )}

<div class="block">
    <label>{'Admin Design'|i18n( 'design/admin_classic/toolbar' )}</label>
    <form method="post" action={"/switchadmindesign/switch"|ezurl}>
        <input type="hidden" name="RedirectURI" value="{$switchadmindesign_current_uri|wash}" />
        {if $switchadmindesign_is_classic}
            <input type="hidden" name="Design" value="admin3" />
            <input class="button" type="submit" name="SwitchAdminDesignButton"
                   value="{'Switch to Admin3'|i18n( 'design/admin_classic/toolbar' )}" />
        {else}
            <input type="hidden" name="Design" value="admin_classic" />
            <input class="button" type="submit" name="SwitchAdminDesignButton"
                   value="{'Switch to Classic'|i18n( 'design/admin_classic/toolbar' )}" />
        {/if}
    </form>
</div>

{undef $switchadmindesign_info $switchadmindesign_is_classic $switchadmindesign_current_uri}
