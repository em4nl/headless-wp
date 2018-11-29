<div class="wrap">
    <h2>Headless theme options</h2>
    <form method="post" action="options.php">
        <?php settings_fields('em4nl_headless'); ?>
        <?php do_settings_sections('em4nl_headless'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label for="em4nl_headless_command_or_webhook">Command or Webhook</label>
                </th>
                <td>
                    <input
                        id="em4nl_headless_command_or_webhook"
                        type="text"
                        name="em4nl_headless_command_or_webhook"
                        value="<?php echo esc_attr(get_option('em4nl_headless_command_or_webhook')); ?>"
                        class="regular-text code"
                    />
                    <p class="description">
                        Either a local command or a webhook that will be called everytime a post is saved.
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="em4nl_headless_is_webhook">Is Webhook</label>
                </th>
                <td>
                    <input
                        id="em4nl_headless_is_webhook"
                        type="checkbox"
                        name="em4nl_headless_is_webhook"
                        <?php if (get_option('em4nl_headless_is_webhook')): ?>checked<?php endif; ?>
                    />
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="em4nl_headless_redirect_url">Redirect URL</label>
                </th>
                <td>
                    <input
                        id="em4nl_headless_redirect_url"
                        type="url"
                        name="em4nl_headless_redirect_url"
                        value="<?php echo esc_attr(get_option('em4nl_headless_redirect_url')); ?>"
                        class="regular-text code"
                    />
                    <p class="description">
                        A URL to redirect "frontend" requests from this WordPress to, e.g. the URL of the home page of the actual frontend. (Leave empty for no redirect)
                    </p>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="em4nl_headless_is_webhook">Redirect is permanent</label>
                </th>
                <td>
                    <input
                        id="em4nl_headless_redirect_is_permanent"
                        type="checkbox"
                        name="em4nl_headless_redirect_is_permanent"
                        <?php if (get_option('em4nl_headless_redirect_is_permanent')): ?>checked<?php endif; ?>
                    />
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
