<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-color: #f1f5f9; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px; background-color: #ffffff; border-radius: 32px; overflow: hidden; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);">

                    <tr><td height="8" style="background-color: #4f46e5;"></td></tr>

                    <tr>
                        <td style="padding: 30px 40px 40px 40px; text-align: center;">
                            <p style="color: #475569; font-size: 16px; line-height: 1.6; margin-bottom: 24px;">
                                Salut ! <br>
                                <strong>{{ $colocation->name }}</strong> vous invite à rejoindre le colocation
                                <span style="color: #4f46e5; font-weight: 800;">"{{ $colocation->name }}"</span> sur ColocManager.
                            </p>

                            <div style="background-color: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 16px; padding: 20px; margin-bottom: 30px;">
                                <p style="color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase; margin: 0 0 8px 0;">Votre Token d'accès unique</p>
                                <p style="color: #0f172a; font-size: 20px; font-family: monospace; font-weight: 800; letter-spacing: 4px; margin: 0;">{{ $token }}</p>
                            </div>

                            <p style="color: #64748b; font-size: 14px; margin-bottom: 32px;">
                                Cliquez sur le bouton ci-dessous pour accepter l'invitation et commencer à gérer vos dépenses communes.
                            </p>

                            <table border="0" cellspacing="0" cellpadding="0" style="margin: 0 auto;">
                                <tr>
                                    <td align="center" bgcolor="#0f172a" style="border-radius: 14px;">
                                        <a href="{{ route('invitations.accept', ['token' => $token]) }}" target="_blank" style="display: inline-block; padding: 18px 40px; font-size: 14px; font-weight: 800; color: #ffffff; text-decoration: none; text-transform: uppercase; letter-spacing: 0.1em;">
                                            Rejoindre la colocation
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px 40px; background-color: #fafafa; border-top: 1px solid #f1f5f9; text-align: center;">
                            <p style="color: #94a3b8; font-size: 11px; line-height: 1.5; margin: 0;">
                                <strong>Pourquoi ColocManager ?</strong><br>
                                Suivi des factures, équilibre des dettes et système de réputation pour une cohabitation sans stress.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
