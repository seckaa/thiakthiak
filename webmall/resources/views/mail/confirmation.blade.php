{{-- @component('mail::message')
    Sign up here
    {{ $name }}

    @component('mail::button', ['url' => 'https://www.google.com'])
        click here
    @endcomponent
@endcomponent --}}




<!doctype html>
<html lang="en">

<x-mail.header>
</x-mail.header>

<body>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
        <tr>
            <td>&nbsp;</td>
            <td class="container">
                <div class="content">

                    <!-- START CENTERED WHITE CONTAINER -->
                    <span class="preheader">Your confirmation email Mr/Mrs {{ $name }}</span>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main">

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="wrapper">
                                <p>Hi there Mr/Mrs {{ $name }}, </p>
                                <p>Your request has been process</p>
                                {{-- <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                                    class="btn btn-primary">
                                    <tbody>
                                        <tr>
                                            <td align="left">
                                                <table role="presentation" border="0" cellpadding="0"
                                                    cellspacing="0">
                                                    <tbody>
                                                        <tr>
                                                            <td> <a href="https://mopointofsales.com"
                                                                    target="_blank">Call To
                                                                    Action</a> </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table> --}}
                                <p>Thanks. Mo POS</p>
                                <p>..</p>
                            </td>
                        </tr>

                        <!-- END MAIN CONTENT AREA -->
                    </table>

                    <!-- START FOOTER -->
                    <div class="footer">
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="content-block">
                                    <span class="apple-link">Company Inc, 7-11 Commercial Ct, Belfast BT1 2NB</span>
                                    <br> Don't like these emails? <a href="https://mopointofsales.com">Unsubscribe</a>.
                                </td>
                            </tr>
                            <tr>
                                <td class="content-block powered-by">
                                    Powered by <a href="https://mopointofsales.com">MoPOS</a>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <!-- END FOOTER -->

                    <!-- END CENTERED WHITE CONTAINER -->
                </div>
            </td>
            <td>&nbsp;</td>
        </tr>
    </table>
</body>

</html>
