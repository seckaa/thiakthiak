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
                    <span class="preheader">{{ $subject }}</span>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main">

                        <!-- START MAIN CONTENT AREA -->
                        <tr>
                            <td class="wrapper">
                                <p>Hi there </p>
                                <p>this message is from {{ $fromName }}</p>
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0"
                                    class="btn btn-primary">
                                    {{-- <tbody>
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
                                    </tbody> --}}
                                </table>
                                <p>Subject</p>
                                <p>{{ $subject }}</p>
                                <p>Body of the message</p>
                                <p>{{ $body }}</p>
                                </p>
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
                                    <br> Don't like these emails? <a href="https://pbbrasserie.com">Unsubscribe</a>.
                                </td>
                            </tr>
                            <tr>
                                <td class="content-block powered-by">
                                    Powered by <a href="info@pbbrasserie.com">info@pbbrasserie.com</a>
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
    <script>
        $(document).ready(function() {

        });
    </script>
</body>

</html>
