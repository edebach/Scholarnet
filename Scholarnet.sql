PGDMP     7    
                {        
   Scholarnet    15.2    15.2                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16403 
   Scholarnet    DATABASE        CREATE DATABASE "Scholarnet" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Italian_Italy.1252';
    DROP DATABASE "Scholarnet";
                postgres    false            �            1259    32864    corso    TABLE     �   CREATE TABLE public.corso (
    codice character varying(8) NOT NULL,
    nome character varying(50) NOT NULL,
    materia character varying(50),
    "numeroIscritti" numeric(5,0),
    link character varying(150) NOT NULL
);
    DROP TABLE public.corso;
       public         heap    postgres    false            �            1259    32867    insegna    TABLE     v   CREATE TABLE public.insegna (
    docente character varying(50) NOT NULL,
    corso character varying(50) NOT NULL
);
    DROP TABLE public.insegna;
       public         heap    postgres    false            �            1259    32870 	   partecipa    TABLE     y   CREATE TABLE public.partecipa (
    studente character varying(50) NOT NULL,
    corso character varying(50) NOT NULL
);
    DROP TABLE public.partecipa;
       public         heap    postgres    false            �            1259    32873 
   recensione    TABLE       CREATE TABLE public.recensione (
    utente character varying(50) NOT NULL,
    data timestamp without time zone NOT NULL,
    stelle character varying(5) NOT NULL,
    descrizione character varying(250) DEFAULT NULL::character varying,
    nome_recensione character varying(100)
);
    DROP TABLE public.recensione;
       public         heap    postgres    false            �            1259    32877    utente    TABLE     M  CREATE TABLE public.utente (
    nome character varying(30) NOT NULL,
    cognome character varying(30) NOT NULL,
    email character varying(50) NOT NULL,
    pass character varying(100) NOT NULL,
    istituto character varying(50),
    sesso character varying(10) NOT NULL,
    "dataN" date NOT NULL,
    "flagStudente" boolean
);
    DROP TABLE public.utente;
       public         heap    postgres    false                      0    32864    corso 
   TABLE DATA           N   COPY public.corso (codice, nome, materia, "numeroIscritti", link) FROM stdin;
    public          postgres    false    214   _                 0    32867    insegna 
   TABLE DATA           1   COPY public.insegna (docente, corso) FROM stdin;
    public          postgres    false    215   �                 0    32870 	   partecipa 
   TABLE DATA           4   COPY public.partecipa (studente, corso) FROM stdin;
    public          postgres    false    216   J                 0    32873 
   recensione 
   TABLE DATA           X   COPY public.recensione (utente, data, stelle, descrizione, nome_recensione) FROM stdin;
    public          postgres    false    217   �                 0    32877    utente 
   TABLE DATA           f   COPY public.utente (nome, cognome, email, pass, istituto, sesso, "dataN", "flagStudente") FROM stdin;
    public          postgres    false    218   qS       v           2606    32881    corso corso_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.corso
    ADD CONSTRAINT corso_pkey PRIMARY KEY (codice);
 :   ALTER TABLE ONLY public.corso DROP CONSTRAINT corso_pkey;
       public            postgres    false    214            z           2606    32883    partecipa pk_partecipa 
   CONSTRAINT     a   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT pk_partecipa PRIMARY KEY (studente, corso);
 @   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT pk_partecipa;
       public            postgres    false    216    216            |           2606    32885    recensione pk_recensione 
   CONSTRAINT     `   ALTER TABLE ONLY public.recensione
    ADD CONSTRAINT pk_recensione PRIMARY KEY (utente, data);
 B   ALTER TABLE ONLY public.recensione DROP CONSTRAINT pk_recensione;
       public            postgres    false    217    217            x           2606    32887    insegna primary_key 
   CONSTRAINT     ]   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT primary_key PRIMARY KEY (docente, corso);
 =   ALTER TABLE ONLY public.insegna DROP CONSTRAINT primary_key;
       public            postgres    false    215    215            ~           2606    32889    utente utente_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.utente
    ADD CONSTRAINT utente_pkey PRIMARY KEY (email);
 <   ALTER TABLE ONLY public.utente DROP CONSTRAINT utente_pkey;
       public            postgres    false    218                       2606    32890    insegna fk_corso    FK CONSTRAINT     q   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT fk_corso FOREIGN KEY (corso) REFERENCES public.corso(codice);
 :   ALTER TABLE ONLY public.insegna DROP CONSTRAINT fk_corso;
       public          postgres    false    214    3190    215            �           2606    32895    partecipa fk_corso    FK CONSTRAINT     s   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT fk_corso FOREIGN KEY (corso) REFERENCES public.corso(codice);
 <   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT fk_corso;
       public          postgres    false    3190    214    216            �           2606    32900    insegna fk_docente    FK CONSTRAINT     u   ALTER TABLE ONLY public.insegna
    ADD CONSTRAINT fk_docente FOREIGN KEY (docente) REFERENCES public.utente(email);
 <   ALTER TABLE ONLY public.insegna DROP CONSTRAINT fk_docente;
       public          postgres    false    3198    215    218            �           2606    32905    partecipa fk_studente    FK CONSTRAINT     y   ALTER TABLE ONLY public.partecipa
    ADD CONSTRAINT fk_studente FOREIGN KEY (studente) REFERENCES public.utente(email);
 ?   ALTER TABLE ONLY public.partecipa DROP CONSTRAINT fk_studente;
       public          postgres    false    218    216    3198               �   x�u7�t�r�LKMK���4����w�I,.΄P��aP5z\��^�f��>�4�Ԁ5��[F{�s���$��d*�	#΂���Dlf����pw2��v�LIINI�LINƦ�
�%F��� �\?�         H   x��M,J��K�L�K/JM�72sH�M���K���t�26�4���ţ���2���$�� �p'So�=... q%c         >   x��M,J��K�L�K/JM�72sH�M���K���t�26�4���ţ(�=����ۅ+F��� ?�2            x���I�ɑeǎU`xb}�G���XKI�d�$G��:��#R$3�d�����T�ޫ��g����?����1��k�˥��?ۿ��g�럗3������?��
���O�ֹ|���^wY��ll5���юg��ڽ؝S��]����!��Ú���������뿟d�/S~:�xX��j}���Bk��fS�u�{I}�1�+��ޮ]�o)�+%֪֘s���a�]�>��2���?��2���O�!Uwŋ��Mp�_�ܽ��j��zc]��Z&9��	���o�f�8J_�W��w�zR_�~��9����g�-k)-�Tªf�l��[������{��Y��x�)u��O2��1_�~������y��E/2K��%g��K�R{2����>�ؒM��b���#�	���9�p��\�
�S]JM�I���+�V�}�-�`���2��s#4��H��ef?rj{�6��z'��;���pt�"r��`ٴT��3%�ܱ�1��ƭ]���m����}ks�ƅ�R
����EY9�g8=���\O2�t7S�g���8�7ŕ�g�&_��mv�Y��f	��u�n�
�����4XWe>6���]m��B�c���"�e�M�,��*va���Y\�|��珍�-���c���2=�����5U��Xqy�-9W��1�piT�K� *7�sť}.y�ʏ��g*o���I_>~��&��.l8��?�[\8�<3��j�+��5[��O?��U�G�?B�<vb���\��y��'���^�����k��7a�Dgk�s7[\�Wk�l�{8�ov��EOx���d�O�ݕ/�>�d�N���-i�j�&�9����My�+��[����[�=�?Lo�O>�ߛ��I�KX�%[X�*k�l[&��-��Ą)�����f�,��P�7���������܉P�~����p'�K��w���La��B��c�<j���,����&k� ������a�����O�5�����\�$
��7�a��-����f_�N�;L���3v�_�(Rܯ�⬿��� �e��#��?�sz�������pd�v��������O�e<�u��Mzn�:�"l�r�_�Z��xȎ��
y���	�_����lv�H�}D�2��V���{��qO�ˍmw��'&���2v���Hq�&�^g�DD kaՆ���w""[L>.�����qNϛo����	�����"��o�b�;�Z��pAת�>��ͬK\oء{2_&~9����.E��VQ6�h�vI&��+��g� 7�6���7�H��&qO#m�z�]�|�۔6r�L&�t��{)3nb;��R��;x!��yYy�
J9��7�x��|V���S����,"_���������<n��?����6έ�Nv�>����&���D��[7��)����~�U��<L�專���r��%loϵ"!6�L-�D����e��o7���h�O�gt��a��,&�Q��]��In/q��n��'�M� ッ��������\�#x�N&��p)c?Ƙ�����iS6'7*��[�	����	�Шl����Y�< ��S/�=����z+.��p���\ ����)�ަ�[)�,�4zkM��?��T乸-����KC�yz�8��ț�z1��kƧk��A�2�q���3�q��U���g��!|\_;v�򖇅���-� �ċ3�Z�cX� �=����Vl��%s�h��:L=��y�p���n��� ��;��WUD_���&�dw�QQ��HX�ZK���/�NK�'R$�*u���W�<���K�dM��gaL6��af	�®�Q �_�vL\��`n����;��x����/Jw��g%����7��GH�Ӷ���2�a!��P���u���B$�N`��*X>�ز熌��s� ��3D6�P�`/�i�SI��#v�^���Rd�'exw+�}�E3lH�k5�̬���dbCA���;�R����P�	��5ɻ�� �Z	�nf�<�7K���`ikV���`��;�_b����� ksm�a���L�E9��ӄ=Jn��1�A4��,ě��fB����;��X*v:�q����D��C�`x��M��t~���7�-?x����ۑE�@�{q�Fn��[/9v�+\��ܫ�?M�[&�`��WL��2��G�����gO���Y#@�^6��n��b�t��;��xA��wx.dA�ȸ
��J��������yc{���(=���S8YIy�X-U��Z�A]T�w��-�[�]���6Tc�I�Zqs��Ľt����H�A�Q�HY�"x	�ءs��&|oԼ�bp�s�h ̀����Z�Z�A��"9���`& � (�i��0ud���hU��6�v琦e?
�]�#*w�AL'T�Ŗ'9�_�����D;��ϻB'>��0ޯ�
�{ȟީ|����脮�|�n4�-vP	{�� Ɔ2����d�mD��i#<�,�U&���������S���&D�Ј�������\��j|���ޒV��gqO��r�7��j��@�
�wt���nͼV�qH3h���.��#�YGx`�	�r���D��S�-�{�v$(	*��[HT�gjE��<n��LE���,޲=av ����k�I���0P��El����ڼ���I+A���w":�Oܳ����S��b�uvb�����Y����3��Q�d��YYL���"���K�qrBk�)��ܒ�#�k�b��C��g����x8h��p(��J&#i:R�!�x���F>��a_ȝY�g��T�ފ�Y("�Iu(��O�$"�v(��������k�D<�0S7A�c/�q��8q��J��R���N���:����.y �m�KК��6
�0�֜��9�r ���'�y�v;|ā���]��+(v�;��m�l&Np���SV�d�OV�P"��w���qzP�
���Va"��'�ӄ��ճ嗭�9e��rx��cJ��N�E,��T��c��pk^�U� �Etڐ��`��#�'��'�J�E�>�BeC��(
|o��r�t�R��@D���r�)e�~�^x/��d��"P�+�����nL�P���'���0iO<os�>�SV�g!Q��Ι������]��{L�E*8+kp����wC�؀��g䈒Jn�U@�}�2AS�t>�\��أݦ��6z��06)D�c��S�TVz�	9�6�&E�|:��:p��}%B8����t�i��$)�#�7k���ܡ$��	��w*Vi�
�n� nw�M�a����Puy"Ԫc�����X6O�����6� ���a]�7y�O5��ܻ=/���RMwƂ�.�*;T��1Q��؃����z�P"��ؐ���#���#���٭g��G�9.�l���Z*L�)#���8�
��&b�����L���R�dAI�/���έw�X���%��@ bpu��y��h �Y
.Be��� �ד����U*$�O�1�*� ���E.s�������a'�g$�<���b֓�]9(�i��?Dx`��<�0��~c�m󛙰�}[
�<�8w����d��9.E�N��4�*�	N�Hw��C$�{�w�O���|X�֖<Tթ2o�n�{%�[�6��J*��4�_NT�q��j
l6�g�py1fs�ڠuU��xP\��ȇ ��*��y!���6�b廕?NYY��XUr�%KV֥qH8qʓ K�$�Cw�&A��.�Ś�"�Qo�=��C���U��<	��8��[e�=��3���Ԯ��R��Z�R?��W�ah�]�WL&��u��2�o�0x�ةV"?|^�<�R<���M/9+��ST7�	�4�d�Љ�ҿS�9+|�B��9��ۦ�l1����
���k��"�N�S�>�Q�{U�f��T+����1���#��zG:�E�a��z�Wev :�>'0�:q�QQ���jc�PsΫ���X�=�O��:�6��6���    m"Fyz����Ith���uaJ�$��N��Ysd%��^쏱%����\G���˥���گ�s�-T���;�7<�����S�*R�.��Jg\�T���L�M٫��$s:�ZcC�� ��+g���k}� �D7!��ӂ*���*x��ń9���+�9fA�=%�nm�NQ��]�-Y	+�(�� �q����Wp�{�)҉C�_V�ܓ�R�s*����rPWL�ٴ C43�q�6Ω�e��+�>!�_�s'�30�B�;\�0��c�@^�[eU�U~y�[�
/�e���R��x�U<��U�)B�����!h��B�C���%��-a�|�ua���I��R��N/��\�O�BD� Q,�+T33$��w�?x� �>���Qm�d�;�O�^UWt.(L<֫dS� v��:ꠂ���z����� ���T��]�Un[z�8Q9+�E�e��=������&�ÍFT�^F�L]r�	9n��2�x�S��g��`83kz����lP
�Y�ܐ�#
�!�8�O����d�b_:j�|P�MUeU���H}����{��iG�s8��9Z# L�V洅(�,4�)V{��M pLDiNι��2��q�L7��3�l��Yv�T	�c��_���@	/`�l��{]S|����M����R�3r�Cg��tz'zGJaBE��9���F.�7���uҩ~$1ߌ�L����VZ��FU�NP�Hgx�@rx7���aB��zU�;ao�6-(�<!��ʹo!*.����e�O1 <�7z�O]��+�u�H�Wv�B���(;��;A	(z-�H���a*�v�M�㥐����y��"��l) 0SZ�;}��9�r��~$嬰((����T���V%���_>q�m��>��-��7���찿��Z�sQ�!���V'g��Z&R���3�8�UaMcA��9<=�ˎ�'��~|�ʹ�k��A� ��UKBE׹P$|�b�$p�ͮ,FR��c�ꖼʵ�"}�I����Z&(������n[���NL�uј�&;n)�3�� xgl�������Зa��qy�q�L,�#���e"��!x���dp�l�w*N���L%x�A� �f�Z�Ut��1QIf�yW����re8�L���uy�"�|d%X�� �ƚ�R�xYaL��릙�>���i��8`��������˨D��j��j�B�`l�M䫪����d\sl>ѳ츋��H)����؛0��!J�SsDy�J�׫�l����Cs,��<U;~�ѣΪ���NCh��4�x�Q�2b���=���f.�L���dk��,;N
�/8���>�%i�d2bfE�����#�g]n��dp�^p|K˗�6+wT��F0Źo���-*�7��1A��ʹ���mBd`j��V�0�d��g�崇g##��*#�<� I��=�*F?\Q%�ʇ|�Y哳2���|�x=I�c||�em]��A���^����UR�JE���S��垕�?��b��"��b� 9	�f*����i�Ą �2%�����ND�Fɯ9�|XzT����{R��H4FM��Մ��y����DD�}���V�9�g�0'guZO�r���4�T&@�����éD��\�U�h.�Fd�= o ��P4�:=d��{"�*씻<Z7J���Q���X���C�&���nA�<���%)3JYϿ�W��>�x�kMMy��;Q6��i6�#��R)?�X_0Jks�`��3%o�k�v4\5�`��w�`����//R�آK�Uj[�.Dt'��O*���{&��6Q*3�� ���u%�_�J��U����/���ޙ0qe�2>Ԫ#P'TLY�YW�˚�7\� _��ٻg�(��K(�Z�ra��{V�o��=���%��ñ:��_̂#!@�k(��(����>G'����#��2���G�p'��� &!R�1�>�}�w��5�B^�>��Aِ�{�buz'~v�aA���";�$��Ú�w���)+�o��NO�U�=���HP�������"l��gv�2@��7珠���OmVwY��2�_��L�鵎�γ{��j��]7`y�����ۣ�*�0Fwi<�;����O���֬Av��l���P�^��$�G����:) �\�Cy��Y<�螆.e�
W��>y��.ʮn�l�@����`��o���N<	)ڞ�;��pqj�RUJ�Rj%�\IHQ��ihxN�ɕ8�vy���bL+�`M�Yv�cyA�:$��Ï���g7	 �)d�NN���К�~�I�u0[�r� �Sû=� j�G��h1�Y�>��-qJ�z'dW�t���T�6ܬw��3r�]m��9#��3nE�� �Q�v�,�h�J�yՆeo�c<�M��K��$��Q�����0����x���XXD���m��Aܣ�3���o�i�U#5�E�d�XBKc��z��X��	P���*�t��fܟ@�x��+|�q@��{A�XDF6ji��d�"D�06���E�!=o��&ݝ�A�=�UI���+�e��_�S#��Ԯ���Q�J�4����
�$S��BȪ-2v>��miŋ6����j���ȵk�GS��ˉ���t�8e�~�tz(�f �>MD�� ,�ll�"R��:D#!BG���Y`<u��eIz�R8�=!wkU�b�^�N�pB-��",p�A��`�F��W_e���gр�IAI-b����.F�I���P )*ٴQ񙐸�����=CG>	�p�l䞬���l��ϪQ�ԅ)qͅ�-%~g�^xN�E9�ʃ�A������tcrF�:h�Q���S8�D,G��q���e�F7��ܑN7�L��7^�M�� DhP-~@Gd�YZʘ�#*:C�D����aO{_>�)���9�]�[��)� �QS`�>u����AT;�״<����de� w��+�e�F��x��K4u�*���G��U�ٺ����9�h�����0�S���Dk	��\96쉻�57��Ju��<A��gՌ9����*z'lO#���Q�d"�Ā�詪a��Cm�iht!���sm�Վ;}.���(�1�&�����cƛ,�'�_9��aM�BC`;�r���\�=�S�3N���9u؄ILq*�~� �vA��KE����	��?B�]�Ɯ����rD�>�ab�1ב6V~��}��Q�Pl�(uAŁ��?����du�sA�S�������H�'���G�Ï��� T��4�T6���v�鉢r�:��(��R3�����x%$G�DB;�HX���!q"~���.���>N�t*��# ~�U���j�b{Fq����%{�k�bx��N~���肎 �*�`x���4���wV�M59��M�Cca���,:�D�=E"����8Ve����A��w�jt��$�<���ෂ':��du� 0���]Y�����-�=Ǫ�w�_�#[3�y-"��8�w-�>6{�{����)�sz9�J���!Ƥ�,�g�3"ڂ��;����<��	:�ë�W�t@ʃLJ�w���
U�*>-�4L)��e,HKl�b�;��E�m�y����ZS�w�D3u�ٮ��S�Dn��Z&���|�7�j�o�_���w��W�U�$�Gݰ	������.>wU<4~����9T��jm�$���kt�9��S�t�s&�ڡJ�����HC ⨭�g��U�Rw�!�ć����x�N0 k����Mu����=av�X�!f�n��*{�%>!��RU;�8�����%�d�Z^I$�Zx�\#�Ϛ�4�����mj�F*W5S�l甦�����SQ��J���1o�qs�������k,Z�E&	~q]l!'���]<~�!��@�)�����h��8�F2�)N�!�i��C����eB\�)W�M��K��9MZf޿y��-]eά�X��`d�P
�� 
r��ްvl0L�>i�R���$�Ń̆X<�:��뉲
X�x��lI��:�T�*�N��@��#_�1L+��~.��D���^�3���"�aȿ��-�\�u�    �D���N��A��I�Cc�5G8J�P�	�Gը��'"�E{������� —��^¶ɚtJh9H���<i��)y�J�MgQ�
Jƴ-��	��)�����K��ы�U�Z8�\{E�zz4��l p%�P�|��O�"
t�s���wU�d�Pj�	���[{.��t�:4گ��
g�(�-�����5<^dk�:�/��Ou�=#G=�Q5l��K�5�z)Zq��Ɨ]'P�XeޣWg&��K+��Qv���T�g�;Q�/i?��)C�4<����H�ϵE.��Փ�ܦ�BF��swn���I�������%�R �1��oᵫ��&�6��U'�5DGaϪ#��M=J�~�I�(ۇ����������j����q�F�H��6�O�㾧��o�J�K���f�rTeaG��ZN/&�5u_3���bFb�#����P���h�:�۫iv�6i�NCVqQ�m��h����u�bܒI�w��)�F�(֪ ��^�j���+�\�ާ�$N��3��/ھ��u(�"	��QK\��zb�����3߶]Z�ild6ϓ�<�����E4B�W��Px��!A*|8�J{xs���+�5�Pf՞�N��F�V:l��m�9�.��5J��C��9f
��&����x�~*xSn�cc!�F��	�5���f�1y=�V�*���{�M}�(���b��h咾Ң@~fm-Z���~��n2�ڐ��w�~��P�x���\�p�jzͮGi(p"86�����))���3���Z�D���fּ�R�Iu�\ 3kݙ6z��fuۻT�J���I����b��-'����jX�����=���n�ܡ��&�<hO�����%I)u	E�'*~2��p��D����C���:�"�{o�=l��~~`���*!`�#�N���чF8�]��8���F��y��G���x寕
�m�Ə\�]����$�����5��`ᖄ���~�����|�+�(M���%9��P�y�&��	�� �'��c�
�u�\����>��81m���j��cva�� �X+�e��	�X;s���7�P�%�o8��3�UU�9,'r��rڤ�1�H+8BL�X䈶
i���9e���N�uBc�=\4������b�E�TU��j}��cV��5x����kp&SŞ#�O�Z���ߐ�`�+���IM!}9]Lp��O��IZ��ю;�߫w�7냦����(῵Əw1Ji�q�vi�W�����>4���P��ݓ��I
�Ɯ+6J���TP�2"'�f�5x��N!@v�b�{D8U�o[��ާ�O*S=ö�}��`e@�m�j��\jt�s��oo_�tu���ϼ�(mU�2�Q���
yM���t�̀C��Hs�Ka�5d�q���2V�4��8a�j����^`�U;, øg+�	[����R'���4��\&�3�����`�Q�r�6(�\��Qi�>p<�BEne��.Ʌ�:ܡ����u���������K�4"vEY��n\�� �R!3�6Yݙ���[����s	q�S#ʙ�7J�o�po�U��םFIޢ�:j�-eeOD���`���i�LK�Sfg�:��7XJ��y�A;�����ԟ�{[�k�ʍUǻ꡾���wU���fq���8��Q�D^>�N{��Xك��S`<�9�&��k�p ܽk8�Jj�/�����`׼�C�_�s��n*_�*�J�PP��!����VFa�H��X��)��eA��+vͫe8Ec�Z��M��/u����84(��U��U��X��jP�b��w�3g���C�r�iU^��@F;���Z��f|��p��kŢ�`{�����ru͞�"S�XM�S9p1պ��
�P�e�4y��E��0�%�X��?�ts	��&�V��2pf��\��$F-�Ԕ��g�T�
�iM\��f��A�ߋ�b:���iV5�5욂�J�����R� ��L������C~�|TvQi ��mU�APS^\����	���vti�,�ۀ�^%�ҟV���w��&`ݚ/��#�,LaS�ڞr���T�56��=���>y��m�����-��V/o�٬��L�c/o����~��5}�_��5>W;~��Ӧ���2J��
܉��j���+k6�[��
�o&<ͱ@7#RQ+q^+��y�W,/(�iqʬ���͹�a�qv>�C�I���j���'��m$N�+�>�k�*w�� �"�6��h��b�f���vv�)��ʰ���6�Q~7$�ޫeAmW�҉n䜜U���M�>���T��I;puV��O�˞�4����UD'͆͠8��"&e�l>;ʅ��sS���4�����7��S�w1���	�ܝ�8��1��	������x�w5�`l�zKZٻ�.�	&�ޝ�A*س�g�[G4DI�Eb�W�s�v�FE�Ⱦ�#9Mw�������`�1h��uN����7}��:̋X�t����35�I+1�S.
gN� ��<	��1���Z�T1[����e�7�O��HGLǴ�;�Y�v�K(�������m�ͅ\*h�})��V�ӄg�6y��R��k9�*IL<��,��_��@]P�p�22,�jk[�cY�j�N��+��X�;�g�"�J��.:����E��pKF�Ț2W���]���ŮB����*+�F�@ȩ����<���p�)bgY��.�
{^�9�L�˩�7Be��X��1)����x��2j�C��ڋ
�к�J��_�f
���3�^rV�lQ�FPqO��ϔ|Pj����>�p+C/����F�i�Z�������
�� ��\NT��N�ƫ��	�5���:X���r�p�o��z:����"�V�/�� 5��<^��e�R�3a~i�M�}t������a���Mw�"���u�L���Y��j�|��L�^�l�8�=-1z�w��|��:�"?<{�6�U����(����K	���I��}�/t���|�[��]��O]�2a�>�ֳ�&�Y.~�x��jߎ֤\�g�O�t{�X����@�\|���iL��~Y̆�f�����!LtՂ�3t�3qfʣ�39�$�)S�5�e���jEf@`�Ba����E�h_������'�l�����E$LZ�N4͖�����L#�ģV��g�~IF[�#}�p�9� ܨT��\��ze�+��Uj	�~׮ +��V��V	�Ϧ��J�;&��/._YQ�n׃D �˿���\�m�o��<4��g�q���k�UV.�{i�0������V2&%��Av�.�������m��^�!1�>?�W�q[K�Uf�M�	�ʦ{�W2WD'�л�|��/��4��œ��㨶wϙͺ<��?:cQ�Ajt�R�1� ?xը�yLYBfT)M2�NT�4�h|G~B����V����8�6�k�W&��^�K姀��*���Kb�x��h�����V���e{;��.m/m���:�~�E��E�Z(PP(��j�h&�+9V{�hO�O���ֲ_��b;�_�w7�Y	�����*C=P��7FV=/m}k�VVt�zA�|FK�T�F+�3V��T�S�_c�'��6�!�!�+}@���{�l�5��̪e�8gx�X�S�7g�֝�����9��6f�P�dڍ��K�gp0͉n�f�����"��I�hp��jG��q��5���O8 L��_����1�f�vo��;��m�Ԣԫ��%T������qS+���>�^�f���14h��D{�(�74��\4]!'D(=��J{��UC��<�AɒY�q�WU�?��k�U���!~�?��y���1����&/Ӛ�qd@����.c��+�/Վ��|/�g�|Q#�ҢE� �A�Қ�,�mH��qY'�u�g</}�P��6��"�&�3�g��w� i���q+4��>󖘹�R]���H��x���oS���w��Oʎ�M��k[/�=:}�F���w���E��1|j�ܻ�������U��M(�N�Cfq�)�X*U�f���n]���+�!_ �  �6̷�r�W��|���]�j�]�ʶ*�u�g�F��Gĭ�n4f��KR���8Y�o����E�fi�YB�}�L��נ,��7 ����M=�cb�/���mN^�@P۩R��/m�8���W�Q��WV���-����*��d��N�<h�\N<�!dЇi½5��@b+���^c��q�
aGq�8�s�J��{k�z	a�'k��9f-��3
P�Ϯ�;������mPêY��4P�W�9���P�YЀ�8LO�,�7��&-Q+m�]/KC�K�Re��%�w���mm�77��MaIԷXiI&�υ3_9�g� ����n�:��l��[}tJY�Ee}����N{�}�=	�$�7se""�ԫ��k����6�������F�7�20\���,�R��"�-�G�/HH��Χ��kw��I��^{Z.Q��H�����e�wC�Ӂ �1�既�_*�Eu��'������J :�@��ch��7>���Zlp�f��qFڳ�v^�C��SMv*��Y8�T���h"b����
`o1�kVB�Ѡh!i����S5�#G+�M�bY�^p�[Q9�V1�������	6]�L�r��j������C`п�R�ÛT�����
��|k�X�+�]G�7x�T��J���r����!P���DV���K�T[!��̐�0"�b]�檠]k!M���X�F;��B��QS��泉�	hxEܝ|d���	'Wu'���(:P�=���i�Q3��D�U�Ϫ=HkR1*��C����K{x�ւ��������d�&���g�&�O�#�`/v�`Tr�w�����с(�&�/g0��+��b���ϾO����sl/�
�|j�I[�]�f�\%���\q���2�1v�e�]��f�[��콛L0s���
Y �\�ڻ���V���9�����+�4����B��FO�Zᰅ��� |V�u��e��%-�U�Ƅ�{��|Z���~��'c�I6݋՛vA	�;���.K�ä/4��/�s�7�5wQ���<V�K" �f u��h��Vffy�[D!��c�U.Iߖ���*|/Q��X."�5�x�����ڬ�aBhiN�`�ƌK�z}S�6����i�,_�'FԳ��~�'}s����YS#h6�r*yB'{Q>��}9.Ъ✓L�u�_Y�߃�I���g�XxF����PoI������Nx��� F9_7��dm�~,��|���r}��mZ�_j�2T}��hgX�y�ʹi��#��6�̨����?ZFR�5��q�ATN��b����7,��/݄�:�GnI�,[<��5��w��[�i��Y��ϊ�
��-ͨ�6���W�E�E�;9�B�M�YU-]K}]Fr�.@��;�H���{���R|y�V��)�t4^_?A)�6yK�����S��_�5�$���19gU�>Q�C����=[��x1z�,ڗ�i���uY݉�pV�c�0�ֶf�@}|)�ĭa��s|Zc�ј�k�xb���v܀x*������Hڇ���	��;�]a���;0��٣u��!�j�6��R)�]�g�_�W�8��Y�W�-���������Җ�>�l[�H=��3x���=!=��S��Y咠��[״�
���C��x��2Z�Ԭ�=�)�,�i��N�g%f�P^��n!v����7}˱u�W����⮚�R��&��.�<�YmϪm.ߜ�W����\�
9��pw�c���լG���^��$��B�j_��Y�k-�ƭ��ٲ�c��_W��F}�[r��T�y���������w����=j��hCC��H}�V��;�K��Z��Ԟ��j�y[d�̩S�{�n0g�"�gv2I+�3`N�.���e����j6u�/~�MxHj�ϗ#��(�6hp�k\<�/9ֆY�L�n�	qArlw��=�u���f�Y�c~��S0��c����=O.������L�t)�P���^���������#���         �  x�uU�n7=�_�X��HJ��^�S{�"%�@�[��rv] S��=hvg���~�o�\~~�/�V�������I?<<���{~*H��/�ӯ��q}�n哽��υ ��x!-�����e�*��O�|�?�_�T/����n=��v����r��z{x����yL@�m�W��w��������28�AQڦ�t�$�u�6Bl��v�����uN������� o�J�˔�s�S�m��m�R�ޮ88.�/��#��1�ʻ�N�l.�=k�wC�4iw$P��!�&�Q�AaK�:E��-^�=�pl̶mh	���l�;(Xv֐e4l�����!?�ӸV ����	�*�B+4M�Y�H��wD=q}��+Ɂ��}�W/�O8i��w�y1/e�5���h�W#������a���ˬe��[cv-@�ʳ��ad�3�N�˵�f<'o��ܨIl��i��ұ��-v1�Xyi��|����6m8\S�K0�bΫ��A]ȹbo�%�t���1��l��$���g��c���g��%�Q�TXdDZS��p�:Y��&�֛n)Z���k���]k�^��zi�6`	�g�]mq d�ɰk�ږO�C��4�6�Η#���R��FI�36$���E���=����`��N̖>>�������0%���[�4����hQU��i	����l|tI�쬛5��=i��R��:�g(��4�4d����2ߪ2����\n����������g�9�[����F9��Vo���|;|�s��;�
��.�Jj��c��ט��B�2{�6���j�����k�[��z����!���;�h��2<��3�\��Y��^G`�瀭�83I��N�%|�>���o:�뮻�T?bj��J&fZ�u΃��<*3����E�{���(���l�}�c>�[��-~������C�     