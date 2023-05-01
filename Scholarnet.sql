PGDMP     )    
                {        
   Scholarnet    15.2    15.2                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                        0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            !           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            "           1262    16403 
   Scholarnet    DATABASE        CREATE DATABASE "Scholarnet" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Italian_Italy.1252';
    DROP DATABASE "Scholarnet";
                postgres    false            �            1259    41071    compito    TABLE     G  CREATE TABLE public.compito (
    classe character varying(8) NOT NULL,
    titolo character varying(255) NOT NULL,
    testo text NOT NULL,
    allegati character varying(255),
    utente character varying(255) NOT NULL,
    data_scadenza date,
    ora time without time zone,
    pubblicazione timestamp without time zone
);
    DROP TABLE public.compito;
       public         heap    postgres    false            �            1259    41076    corso    TABLE     �   CREATE TABLE public.corso (
    codice character varying(8) NOT NULL,
    nome character varying(50) NOT NULL,
    materia character varying(50),
    link character varying(150) NOT NULL
);
    DROP TABLE public.corso;
       public         heap    postgres    false            �            1259    41079    insegna    TABLE     v   CREATE TABLE public.insegna (
    docente character varying(50) NOT NULL,
    corso character varying(50) NOT NULL
);
    DROP TABLE public.insegna;
       public         heap    postgres    false            �            1259    41082 	   partecipa    TABLE     y   CREATE TABLE public.partecipa (
    studente character varying(50) NOT NULL,
    corso character varying(50) NOT NULL
);
    DROP TABLE public.partecipa;
       public         heap    postgres    false            �            1259    41085 
   recensione    TABLE       CREATE TABLE public.recensione (
    utente character varying(50) NOT NULL,
    data timestamp without time zone NOT NULL,
    stelle character varying(5) NOT NULL,
    descrizione character varying(250) DEFAULT NULL::character varying,
    nome_recensione character varying(100)
);
    DROP TABLE public.recensione;
       public         heap    postgres    false            �            1259    41089    utente    TABLE     �  CREATE TABLE public.utente (
    nome character varying(30) NOT NULL,
    cognome character varying(30) NOT NULL,
    email character varying(50) NOT NULL,
    pass character varying(100) NOT NULL,
    istituto character varying(50),
    sesso character varying(10) NOT NULL,
    "dataN" date NOT NULL,
    "flagStudente" boolean,
    telefono character varying(20) DEFAULT ''::character varying NOT NULL
);
    DROP TABLE public.utente;
       public         heap    postgres    false                      0    41071    compito 
   TABLE DATA           m   COPY public.compito (classe, titolo, testo, allegati, utente, data_scadenza, ora, pubblicazione) FROM stdin;
    public          postgres    false    214   �                 0    41076    corso 
   TABLE DATA           <   COPY public.corso (codice, nome, materia, link) FROM stdin;
    public          postgres    false    215   +                  0    41079    insegna 
   TABLE DATA           1   COPY public.insegna (docente, corso) FROM stdin;
    public          postgres    false    216   p                  0    41082 	   partecipa 
   TABLE DATA           4   COPY public.partecipa (studente, corso) FROM stdin;
    public          postgres    false    217   �                  0    41085 
   recensione 
   TABLE DATA           X   COPY public.recensione (utente, data, stelle, descrizione, nome_recensione) FROM stdin;
    public          postgres    false    218   �                  0    41089    utente 
   TABLE DATA           p   COPY public.utente (nome, cognome, email, pass, istituto, sesso, "dataN", "flagStudente", telefono) FROM stdin;
    public          postgres    false    219   �X       {           2606    41094    corso corso_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.corso
    ADD CONSTRAINT corso_pkey PRIMARY KEY (codice);
 :   ALTER TABLE ONLY public.corso DROP CONSTRAINT corso_pkey;
       public            postgres    false    215                       2606    41096    partecipa pk_partecipa 
   CONSTRAINT     a   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT pk_partecipa PRIMARY KEY (studente, corso);
 @   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT pk_partecipa;
       public            postgres    false    217    217            �           2606    41098    recensione pk_recensione 
   CONSTRAINT     `   ALTER TABLE ONLY public.recensione
    ADD CONSTRAINT pk_recensione PRIMARY KEY (utente, data);
 B   ALTER TABLE ONLY public.recensione DROP CONSTRAINT pk_recensione;
       public            postgres    false    218    218            }           2606    41100    insegna primary_key 
   CONSTRAINT     ]   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT primary_key PRIMARY KEY (docente, corso);
 =   ALTER TABLE ONLY public.insegna DROP CONSTRAINT primary_key;
       public            postgres    false    216    216            �           2606    41102    utente utente_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.utente
    ADD CONSTRAINT utente_pkey PRIMARY KEY (email);
 <   ALTER TABLE ONLY public.utente DROP CONSTRAINT utente_pkey;
       public            postgres    false    219            �           2606    41103    compito compito_classe_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.compito
    ADD CONSTRAINT compito_classe_fkey FOREIGN KEY (classe) REFERENCES public.corso(codice) ON UPDATE CASCADE ON DELETE CASCADE;
 E   ALTER TABLE ONLY public.compito DROP CONSTRAINT compito_classe_fkey;
       public          postgres    false    215    214    3195            �           2606    41108    partecipa fk_corso    FK CONSTRAINT     �   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT fk_corso FOREIGN KEY (corso) REFERENCES public.corso(codice) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 <   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT fk_corso;
       public          postgres    false    217    215    3195            �           2606    41113    insegna fk_corso    FK CONSTRAINT     �   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT fk_corso FOREIGN KEY (corso) REFERENCES public.corso(codice) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 :   ALTER TABLE ONLY public.insegna DROP CONSTRAINT fk_corso;
       public          postgres    false    215    3195    216            �           2606    41118    insegna fk_docente    FK CONSTRAINT     �   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT fk_docente FOREIGN KEY (docente) REFERENCES public.utente(email) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 <   ALTER TABLE ONLY public.insegna DROP CONSTRAINT fk_docente;
       public          postgres    false    219    3203    216            �           2606    41123    partecipa fk_studente    FK CONSTRAINT     �   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT fk_studente FOREIGN KEY (studente) REFERENCES public.utente(email) ON UPDATE CASCADE ON DELETE CASCADE NOT VALID;
 ?   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT fk_studente;
       public          postgres    false    217    3203    219               i   x�s�rq��2���NJR��������M,J�Wp�L�K/JM���!##c]S]C+0�r�iOKM/*JOM�,OO+OMO%ː����4δҒ�RR���qqq "�5�         5   x�s�rq��2�,��,�+�������w�I,.΄P��NPEz\1z\\\ ۲M         2   x��M,J��K�L�K/JM�72sH�M���K���t�rq��2����� A'            x������ � �            x���I�%ɑ������C���;��F�Jf��E����?�@w�=�$����������N���������h����Z�������?��3���rƹ߬������ᇳ��s�
����=��j�;ߣ5�Z��{�;��s��i]�Bڭ�5]�����������'���)ߝ�xX��j}���Bk��fS�u�{I}�1�+��ޮ]�o)�+%֪֘s}��a�]��}�����L���S~��I5��x�	�㋟��\]m>[o��9]�$�7�����ج�G�����N��欞�o?�Ŝ
O�|��3ǖ����B*aU3O��ح�b��s�=R�,�q�є����'�ݘ���S�)1�$��^d��K��Y�~��d2'z��}�%�|���w�[���qz�<��p�Gȟ�R�hO
��_	���oq��X=��.���gF*�-3���S�c����w�I����Gw,"[
�MK��:S2���k��i��u_!�>��k�޷6��f\-���_�^��c{����k���$�Mw3e~/᫉cyS\�}Vk���fw�e�i�P��Q��v�����w�EpU�c����FH+�`;��*!b^f�T�∮bVo��ŵ�g�}~�x�2�;�asU��p\��C;��j�+.Ϲ%�
�<F.�js�D��v����%��V��1<�L寍�~7量?��djr6S�w�-.S�Gm�����ᚭ������#�o�^;1iz.����'���^�����k��7a�Dgk�s7[\�Wk�l�{8�ov��oEOx�_�d�w�ݕ�}"?��zi5v[�*ՎM�s\�!�-���WX����땷.{�5��޶�|��6=Ǔ�`!��l`u���ղm�p��4��h{�	@�d�B���Y�Fv֯�r'B��n��;9_b�����`�k�z���Q{`�f�/O^7Y��܆o��c��:D\��6>�����s>pY�(4s�D�U��ؿK\WO�}�;�6�0'3�ؑsE��~5`�g��'�q-���ĵ�i�ӛ���w�ؿu%Ǆ#�0��~'����x�lf~/㉭+n
�s��) aK���2�b�@v|��P���L�`�*�& Wg�;EB`�#��-��mF���{_nl����81����dD���4���:�%"X˨6D? ^��b�q�O�6�x��sz�|�T���L(������}k�ݙ�rv��Vm&�18Dnf�X�z�ݓ�a�g>����ҥ(�|�*�m�n#Ʉ�x�~�l���f�y��0��f�ࡓc�$�i�m]+ �~��Fn��ğ��z/e�Ml�]
�?`/d~s^V��Rι���M"^��-��83��f�~���װ��Ḥ9b���~ ���w�m�a��Vy';y����CB��t"�譛~����ux?�*k����氈���r��%loϵ"!6�L-�D����e��o7���h�O�gt��a��,&�Q��]��In/q��n��'�M� ッ��������\�#x�N&|�p)c?Ƙ�����iS6'7*��[�	����	�Шl����Y�< ��]/�=����z+.��p���\ ����)�ަ�[)�,�4zkM��?��T乸-����KC�yz�8��ț�z1��kƧk��A�2�q���5�q��U���g��!|\_;v�򖇅���-� �ċ3�Z�cX� �=����Vl��%s�h��:L=��y�p���n��� ��;��WUD_���&�dw�QQ��HX�ZK���/�NK�'R$�*u���W�y^��>�ɚ*��*l"^���i�]��@���호�}��8[y�v���*���_��(+�J �#�od���h�m��e�)�BZ7�"3?��=�H����U�|��e��U�A�1g�.lb�B�^�Ӹ����G츽
���"��O���V 	(�&X�f"ؐ8\�j��YG]�Ć��Qw��
��C�&PJ��$�RW,@j%x.��!��,�����Y��j����G���I\�+R8�3w��͵��7�3q��&N�(�!�V��W �o��	I�����b}���`ƅ�7h{�17(y��VD�7-"P
��i�v܄�|��R��~lGE��5�%O�o��t�ɯp5r�&�4Qoq���r^1YO��0$DS��۟=Y�g�
g� 	Dz�D$�i��!lӱ�W�������ṐE"�* ˳*���o8��I��<�.��<�3v�O�dA$��b�T��j�uQ��?�XLpnv�J���P�&k���3v��a�'c #��F!#e-���%�b��a~��Q���Y�J̡��0b�;v�Dhk���� ���� ��P��G���ԑ��_��U�/یڝC���(<�vI2����1�P�[�0�7~9B{��:� ?�
�� ��lx��*T�< z��Ü'E�G't���v�Ao��J�<06�)�.�g%l#��hL�Yxd!�2!�?Ĕƭ�����4!J�Fd��\(�^��zW+�stp������<�{�%����VK,�V�8��G/�uk�:��@�AK��ewy	�:�{O������� �V�
�m���+��#AIPqmP�B�z�8S+
��q�tw`*�����g��	�@���]Lr�����V/b�lT��5W�`xMZ	z������$x➵��`��BW����5m].�R�Ϙ!�g숺&K���b��m���\Z��Z��_ H�`�,�_�L���=C�mG����@㕅Cq�%�U2IӑR��˥�6�]�B��
?k����:��V��B��N�Cylx*&��C�M��7��إ]s%�9�����{y@�svƉKĠW"����_݄v.��A���w�@l\��dW�Q���|������|=A�а��#dFG���J_A� @��)dl�f3q*�3�����'S�ڄ����U��ӃJfP0/�
9���=��&l��-�lݘ�)+�u��SrH�w�-b|�ܠ
�@cl�[�J	-�ӆ�l��/!�=�$�8T�,z �*�@Q�{[�E�˨��<"�o���3O)�����{�� c���
_ᗘ���tcʄ�<<!�׆I{�y�s����R&89�� }vΜ��ݎ�����cZ,Rq��XY�6�M�J���<#G��Pr[���C�	���q�Z}��6���4̀�I!Z�E�B���;Oȡ�A84)�8��ӡց��+����\��KO��/ I�`��Y��o�%1�L��S�JT@gt[q��n�c�������V˔ݜ�Ųy*w��T��@�Y�Dv�
0����G|����N���ya�j�30�t�W١�A��O5�4ܰ��6��ۄҘ�@X]Ćĥ\Xva縔�n=CG?R��p�d�N�Ra�N�fW&��>P�mp4��}'����`b�V��&;J�|Q��tn�CŚ��/.�5��@ ��3��Γ�G��Rp*�\�὞�'_�R!����9�PA�D.r���E|$ ހ;�> i��Q�����AIL���!��+ࡅ���+o��̄����R(��a���s �~%K��9p)�vJ5O����P�Mp�D���� �"�#�C~�w��ê���
`�N�y[v��+ܲ�1�URq�d�)�r�bx�DWS`�y=��ȋ1�����bDăʨ����E>��V�G����Ƕ��+߭�r�ʊUĪ�.Y��.�CS�X�'��;6	"�vy.�����z[��������,��I G�A`��*��	�ğ��4��v����5��b�����@�����`2�0��3Ζ	}�����N����B��a����%olz�Yٯ옢�����H�4X��&{��NԖ��z�Y��͑T�65g����UP�@�^�<�v�R���F���{�R5s��Z9ހ<\�Ȉaux'���;�I-"����*+�� �б`�9��։#���'W���s^uE����<x�@����t     �^gn1��C�mG�O�C���Sr%�v�vϚ#+	���`�-�����:"���].� �#'�~-��l�z� m�a��P�O����W�
u���U:����2m_0f�th�^U�&����zx.vX9���^냠�x'"�	I%֘T��V��� ,&�A�5�]9�1*�)auk�t�RG�:o��JXaG���F�kX�Ө�� g�ݸ���cN�N�����
�T����P������
`zu@Ȧ��ɏo�qN�/�t])�	9�̞;���b���׀)���:��*����ˋw��Uxq,�G��b�?�C��!&��LTM4A3 �+�� N�.I�o	�曯3\M�o�ru4pz�4�*
"z�2`^��q�!q �[���k��&�j��$;ܡ~*����sAy`���^%�2�{U�QT��������h���ͧb��
�r��ĉ�Y�.:�,��d(��X�6�n4Z����0reꒋO�q�o�����
<<K%ÙY�ko�u�g�RP\�2��Q��Ƒ}���&;��Q���
m�*�*�LG�K���KMN�8�0���1Ќ�A��a���2�-D�f�aL�ڃm�c"Jsr�- ��6�����gB�ɸ-�	fS��ϲ�蘠J���~��DhJx�f[��;��Ev�ȇm��x�p�Z���:����;��;R
*�]�	]���5r���N�Ю�N�#��fLe�g�_��"��6��w�bE"8�#�û�B�իB�	{;�iAI�	!o]V�}	Qq	�ϖ?-�|�ၰ ��3|�b�t^���t�@�"����G���	J@�kIDZ��SQ�cl/�%|t��qeK���B|��s}�Y��$�#)g�EAQ�,Ed�j=0�*(��[o����l�����fe��Y�P�"����T�:9;��2�Z�4�qĉ�
k����	��]v=I ��W��]�p���5�Z*�΅"���'�cnve1�:sV��U�E�N
Uu��2A!������o00�u�µ�^p�`z�����7�qK)8�Q��;c{�� ~\ew������3�db�Q�/�#��C7'À�e[�Sq�F�`(A�g(�0cԺ����Jj0+ͻ��+év`�X'�˫�g�#+�� �6�D����rcr��_7����T^O�d���e�M�\F%J�U��V#�cSm"_U�d-E%���c�e�]�GJIv@L��ބ���Qڜ�#�c�8WJ�^e�N���caD���(�uV�p^t�@����s�b��3F�6��5sYPfB$$[��g�qP��u��Q-I�&�3+�?<�H�=�r�]%�����[Z���Y�sOE�r�4�)�mx3,nQa�Y� �	��8�m���l"S���j��'�T�8+�/�=<q��TѸ�yIҍ�T��0��B�*�T>�s�*���9�O���Ij��C-k�rT������e���T*�.g��.��<��wx{������Ix5S9���N3H&&��!(a��UDv":�4J~�Y��ң��E�ޓ��Gz�1j⧭&LG���#-$�&"��E}�:`ι?��99��z�ݥq�2*��Է�N%2H��
�Esq4"��xߔ��Q��!��I�Pa��%�ѺQ�e%���Tǲ��j7Im<�u���Yx�=.I�	P�z�%�m�b�d����Û�^kjZ�ۜ@މ��8TO����J������QZ���帰�)yc\3��᪩L�Ӆ�ި|oxy1��J��]�R��v!��;�4|RQŗ�3��
P���PO,�o�s(A��.P�g쨺-,=}!,W��΄�+s��V�:�bʂϪ�үX�����
��=cGQ�@]B��z��޳*~���WD.Q�G����7��b	\C	��G�Y��/��8h8:�����䖡��?��;�_.�5	�ҍ�a�s����i�����ʆd�kp���;����Q� �ք��w}NY���wz�ǭ��I�D���45��p�a�N>����M�9EVj����堔Q���fN�u�t�ݛ�VS?0��ȫEG/���V�1�K��a���}ⅼ�f��3te;4f���
4%=�L$��	H���k'��E�4t)kU�*���@Mv�Pv�p�f�G���/~Í�p��IH��4��g��S;��R��R+!'�JB�:�NC�srM�D�Ao�ˣ�4�cZq'k2ϲ#��!��~�,��>��H �L!ur��@Ȇ�D��NB���b��9����Qs8>�%D�1�:���Ol��S���;!���;�����f��G�����hC\`�����q+�u9�Z���d!F+TzΫ6�({�1�h���0�]�Ø�'���j������L��0��xŌ��"rP�l�5��_~�O����,�'��ZC}��#��Z�8O0��e'U����p4�~:���7�_ᓍ������"2�QKC�^ C!�؅�Y�H}/z��yk�=4���*�a�J:/��^a��.�F�⼘�o�v����
T*�����U�"���BVm���@�nK+^��Ō�VcTE�]C=���^N�(ߠC�)��D���C5��i"�a�fc������!	:�oU��C�O�Hң�����	�[�+�"��pr�j1�a���<36���*;��_<3�dO
JjC�w1bOR�ͅ�HQɦ��τč�-�0D�:�IІCg#�de�dtV�: �.L�k.h)�;��sz�-��Pd�l�SU�L��3��A��ʿ��Q%b9ⷌ~�^8(�8(5�ٯ�t�1ex���hB�!B{�j�:";��R�� -YP��&�Ǖ��{���GH�\�̡�2@޺UOqH���.�+�|�ڹ����I���&+����_�(�(۸�5���lH]��CU�'���>Bn�Z�ֵ������aE��-5F������'ZKX@\�ʱaO�����W����	B�=�f���PV�;a{I-�R� '�PDOU���hC}�KC����k��v��sqF)���w�0�W-=O�0�d���<���yok"���˯��گ���q�ݴ8'̩��&�Hb�S�����]*�E�|N���r���(7���#R��K�������c%�F�ڄb�D)�*|���=מ&�Ӟr���������D�8<Q��<�~T������株�q�u��NO�+�adD1��ؐ��/���+!9&�ءFb�BͿ��7�0�wQl�q�Si��#��GX�vV���C0��\ĥ-ك^#�� ��u�#o�Ft1U�> ��,��q�'����l�ɹ�4�o�#D�g�q&��)to�Ʊ*��'��׽w�P�{��p�'�9&���8�ٗ&���Q���*��=Wo�8V;#�bٚ��kY�ę�k���y�3v�3�\��<����
�`L
Ȃx��8#�-��ѻ�#0��m`N�#����>��|UL�<Ȥ$z7/�P�����JÔ��[Ƃ���-��^�f�gʿ��5%zG�@4S'a������1�N�&.��`b��˗��1p3������Р+*q�\@xu�X�N�jp�{�0H�@/����sW�C㧪.�ϑސC����9@rN��FǛ� .?eLWO0�a���t���.�4 ��j~�^%)u���J|��*��G��V����T�-�/�f��ub`�a�����g�Pb�r��I�+Uհc��am��N_"L����D⭅7A�5b��9�A��U��f�6j�rU3��vNiZ��(:5�����.�7��P��9�:�Ƣ5[d����r2;�����'B��
��ҐI�� )���{A��n$��
�;$��!�P&�U�r%�T���k��Фe���>��U���U�F��P�� ����k���C�v(EP�LB]<�l��S�㮿�(K��5;�7�͖4��H��"ᔁxD89�%>ô���B��L�ۯ�u<�z�(����1[�B���    %^�hAITZ�����Q��?4�Ys���
��|T�Z�1{"�Z���iz�O Hٙ�%l��I����Dk�ɓ�(��W���tu��dL��a��P��҉*Mqa������Y��˵W䨧G#(��QbE͇���.�@'<]��qW�K�5��NА�޼���N�@�C����p摏���.�L�]��E���K�"H����Q7�3rԃU�fʸ[�^���'hk|�pu�U�=zufb1��"|eG���Iu�q�^������2NÓ�,|��\[�2N�^=i�mj�!`=<w禯:�$���x�N����ZB-�C��^��kj�oSm]ur�PCt�:��ԣ��'��}ț����phz�&�͟j��4�Xa#���:�{�����d�/��zoj�-GUvDy���b�YS��0C^�*f�!V>�k��~���v�þ��f�n�6�4de�V_��Q̼m^�.�-��K�q7���k4P�b�: �_�%���*�b�e�}zM�?�Z���+��_��!�������K�'�߰
x9�mۥe��Ff�<��Ù+�?ZD#��|՟�'�3ڡ���1wO�X�b�Q�+ eV����m�n�#l�?޶��c��l�Y�Ԙ:Ԉ�c���k2�k���꧂7�=6�k��_�8o�o��דjո�2!�\Q������b�I-VΌV.�+-��g�֢5_z��'ٯ&�Ijz��

�7[���ר���z��'Ҁ�a��?��[̟�r(?|����R�"��(t��̚wS�;��df�;�FTЬn{��[�Þ�>�P�q\l��夑`��[�K���V �g<� �m�;t5������ז����$)�.���D�Oft�>���<��}c�Ѿ8BP�r���M���L?�tbA%�x�	�_7�p�� '5�����R�1���4�=V���sU���R!�������+u]R���6^�⺆�,ܒ0���/�������Ǹ⊢�4��:\����g1j�k� �/�{�n=v� �_'������?A�@����A����9f�������PFߛЎ�3�m|e[�)�/8�QU���r"GH(�MA���#��E�h��V�!�SV���D['4v�a����AS��^/6^��KU�ޯf��9f�\���xܽg2U�9B�4���1-��	V��h���җ��w����휤���C��zG{�>h�xz���[k�xW���'l�&xպXm�C�	|�~m�=�m��@k�Y�b���	A5/#rr o&\����d�-ƾG�S���Ѻ�}࡮��2�30lk��QP�֫fJ˥F�:�:���IW�k��̋��V+�U�*Ln��״L�O�1�8���4o��]C����-ceO��9�欶�I.�a�V^��0�q����k�9,u�ξk�I��e�;���N)|v�u)G�hC���E;�V���-T�VV{�\H���H]w�!!~*��=��!���K#aW�ś�ƅ
�*!�R0�i�՝Y�_��pz���>��85���.X q#�4�&��Xu|�i��-���F�RV�D����ȪZ��ʴd�:ev�
{�Q��tia���S{^|O��?�U޹f��Xu����yA�[yW���nAkW�J��5I������[��=�+=�#���i�8���ݻ�󨤦��\�v�+A=�]�?7����5�b�t�� ��_���ɨhe�t������\�Ͻb�ѼZ�S4�uO��.A�R���Q�C�rZZ��\��U����E+���q�=s6�>j>�-ǟFP�d��8�U�nƷz	�i�V,Z
�'��a�_�)W��/2���q�;�S��٪0�Z6 L�wOZԊ9 �\2��_�sO7�P�j�1i�N>+g���E�[Mb�NM)*�x�Ke�����)�`������(�S�08�f�Q�\î)���?�	j(�z�̴�	����:�W��Ge�Pm�+�V�5��):i8����jG�6�B.�H�U�/�i��]�wg�i�� ֭�"88����6���)!g��J5[c��s �-Ǽ�f�Om�ݲ�P�`��6�P���J.��A=��v�9��G�:Y�'�U+[�s���?mj(h)��<����������fS�%����f�#�t3"��R���'yU�򂢟��Z[(ڜ�6g'�S;���Tɯ�9�, pby�F���Hჿ֬rq9�(�jù��@-�j6-�~ig�:�K8�o��gC��Z�q���)��@��Yua��t����M%/��Wg�A~��Կ�YO�?��ZEtB��l�S�-bbQ�惱�\x/<7�Gca�I�{3\<������i��ۚ 1� k��:�?yW��&q�������`������=�~��epDC��]$0yu^8�j�iT����>��t�</n�9��FoZ���(y�G��A�ü��J7N�Q{h9S�C:�p6��ΓP��j���MC��%h��y^V��D��t�tL��ße�`��R����K��]�f��\����fܗ�XmU�1Mx�i�W{)����s��������'�%�� ���W,#�2����8���&�4���[���F-��D�C���\A�P��d���)s%���e��]�*��_{���l�G��ʩ*��SJ�n��"v�5��2���E���t����y#T�[�������+��O(��9Ի���0
�[��T�`���n� �<3�%gu�5k��(�L�ŠF\]�]��2��(�kt�y�&�
jO�/9�p��*`�H��D�Y~��i��?��\�������-`�*����*����m.��(/2!�auz�0Q�	��^]�1.u9�&���GGn!�������x��t�,�+�^��$?��ِ:��F·��$��U�V�C�s���z���͗h��`*�ówN�`�]�{i�\����qZ_�4��7@��@7}-�׼E� ��a�����5-��cPk=�o�W�����W[���hM*��y��$1O���E�x{����g�j>��4)Z��l�m��L�iah�DW-�<CG9cg�<*a�:��N�2�[�_V�L�Vd�`.J�?n\D8���eɉ��{�ϖ���XD¤��D�li���4"L<j���qF�1�d�e�:�WǛ�Juh`�e��W�B�P���	�w�
�"moui�k�`~m*0����AaR9�������p=H��;i}�E�&� ы�C3�zVg=ܽ�]e墺��S�P�����lu #`R�Md����jy~a�(_ߖ�د�����y%���XeF�ܤ�P�l�wAy%sEt�ɇ�)���:N��Y<�Y9�j{��٬�c���3���FG- ��P����ǔ�!dF�"�$sO�Du�@��w�'�L_
h-?n���i��xe�K���T~
�ʡ����Z�$��wh��(;��nu_a�Z��ú�����ox�s1��]$j]Ԭ�E������`B���g����d�H/OHj-�EX(�����qws���in:߯2���,pcd���ַ�leEw�4�g4��jA%j��9ce�He8���5�|2!�i#��b�!b�������v_*���Z��s����;5ysV�i�����CKakc6�i�H��8���Ӝ�Vkv����Ory���g�vT�9�-G)^��Q>���t���] �*�ii�6�q��٦O-J�j�ZB%�k[a7�RH_�3��u�l��\�C�F*K����{Cý�E��2qB�ғQ무	]5T��1�,���{Uu�C;��Y�/j����O��:\���o�a��1�	G�+�M,��2&��B�R��Y���z��5R/-Zt	`� (�)�r�چD|�u�^�z���
�_k�:-�j�;�zF}~��v��B#��3o��k*�u|<��[�GLa����6x��wG������Ի����ۣ�7kޭ!�ygX�ZT���������{�(���;\O�ބR�4:d�����R�pNkv�����
ڰ �  rR��h�|�(7���G��L�u���E�l��['~fh4O�~D�J�Fcv��!�|�����r+	�\4n�vP�%���d��{ʢ�}���;�T�3<&���{�^���U��*�~����Q��:8x5�ul�yeu�m����*�b�Mvpx�Tʃ����ēB}�&�[�ɐ	$����`�5�תv׊c>g�dz?�ƨ��z�Z�c��9� ��j����껚J�6 �7���{O�f��W�K5��΀��΂�}Ëk���V���4$�4+�P�}^�x�z��vЦ�z�!q����D}����d"�\8�#xV�J�i�6/�#~�vx��G���XT��gl��7�'��pL�x3W&"�K�������ہh���M �+?pxlT}c+�E�o��.�,��b}�@��D�����|��v'{���e������x�X�{7�=��j~)���R_T��zR8��j�t�dp�=��n}�S0(\���j�/�g�=�m�:�X<�d���j��CLu��&"f�=M� v�S�V`5!D�����b��,1U3:r���)���7����oCo;n�.}_�`�E��4,g����o	�{1F�k.�;�I՛�٨��Ϸ�����r�ut}Á'J孯4xm�-��>�I�Y�HduK߿��G�"��#�-֥o�
ڵ�����i���/48+5��m>��ΐ��WĠ���GVi@;�p�qU�qR��ۈ���S��.���5��O�Q���ڃ�&��?d�
Zo����m-H*jn��+1kM�k��(�p�Ah��;��bF%'}g�+�����a��rS��x.vh�������=����p˧ƛ��%�mF}�U���G�[� �c�Yv�%m�/��޻	�3'
�����%���y�qme�k9���߾�I���Y��Ѩ�iQ� �P� ց`T��JB��~��������~Ø�u/БOk��گ��1�d�� ɦ{�z��""(�}c��e�{��F��<�e�����.*��a�ǊpI����qm�����,/}�(d�x��%��_Y��%j�E���o��S��7L-�)�Иqi_�oj��4��>����Ĉz6����o�r��;kj��UN%O�d/�G��/�ZU�s������"+�sp8�]:��lr�hV�-�U_۞4�	ϼ��(���0��mޏ��Ø��V�/�:�M��K�Z������9�Q97�z�t���q��K�Hʗ��<�6��isVl[�<���"8���P]S'��-��e�g]���~��Y{k7-�;�;�Y�T����U���sW�j�赨'�Z�i�!���ka���HN��?{ǂIVy}ϔ�S�/ժW?�~�΀���'� (E�&o	�yݟ{j���~�Ɠ��8&���'jxh�4��g��/FՀ�B�R6M5Է.�;�JtXF�����O�/���#��v�Okl\"�p��OLz�ڎOVQ5�I�p�7�!��|ga�+,uVy��x!{�Ξ?�\��&�^*�?+��lÁ������=k���E5��ZB6��]��Ч�m��}�t�'���q�u;�\�{x��W���uHQ#���\F�����G3��%>Mw�	��Ĭʫ��r�-Į� 5���o9��*3��X�U3U���DR�%���=���Y���3�jsVڜK_!G`�A��~��\����}��k�Þ��rVH^�kS7+q��ո5c�:[�v��:��
�٨� Kq��j8o]V���_0U��Nױ��G��mh�Z����
5}'pI�Xk5���V�=o���9u�x����[��N&i{��҅`�`�㾌Q��\ͦ�A��o�	�Cm����)�"���O�K��a+S��cB\П�]�vOm�y���tᘟ+�����:5�5}ϓ����kAe�/S%�A�6�����mi6w����O��?�����]H>���/���?��������������?��������1ڷ����������           x�uU�n#G<��"? ��~ܜC,�=%�\��n������ ٯGrO��@HY,�i�uZɞ������%!���F�h���|I�G�#bZ� yY�9�һ�����|�w~yHBN��HmѪT]t�Ss!�9��|��^��s��s�w����<�h�����NCl�tR�eC*y4/W lG�G��z�ZCK�;�!��BT��,\�xP��ܑ ��!@�oG,wU�m��w���^���� ��{��m�⡷��!>Pf ���pte=CI�M�KE���knD5�}�kGW �+P��Ӝ=��B������#2�����޻���RM?n@p��pC�c��9�Yk)"����,��#�ad�
�J*�s	ڤ)vY2h�莊�e׎J�Ā�EٚE�X���;#KO�������h�rI ���\��e��1�D��u�QH'�d���QT�L�w�i��	�	���-���Ȳ�j!М�4��)86J2ߨ����Ǝ"R3�J����ё�`�MI�l	�<
��]+W��25�ͨ��D5G���X�o����{�\b�#�!�$b!�-}�/�{m��b_W�*�6�� ��Y)Ԛ�Qz��ٞ:+�R��x�#����XV��a���j�o�6��,TxeL:c1��hI�WQ�W�b��jX�S��uVc�i��Qo�������b�1O�5%i<�]��ཊ��{yc��'k�QK�<JWad�=��5[�9mb�+P+1�ܔk��b�&�L�-|���LLg��SR��Em��4	{�i���T��l���r��/�1�1z.�Z
ðN�{g�1�-�@�^GՌՙe҈^�ti,��f�J~u���yz�OgK����^�ni���?��e�.������/��<�ڛ�
���U�_�.+�����w���Ov�|Ӭ��2�k��X`3m|������f=ؓ_�Ng{t?=M�P~�5f����//onm�b�$�c����-C�)2\��������v�q�(_�̴*�᷻���7E+!�     